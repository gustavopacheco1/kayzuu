<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Guild;
use App\Models\GuildInvite;
use App\Models\GuildMembership;
use App\Models\Player;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuildController extends Controller
{
    public function index()
    {
        $guilds = Guild::get(['id', 'name']);

        return view('guild.index', ['guilds' => $guilds]);
    }

    public function show(int $id)
    {
        $guild = Guild::findOrFail($id)->with([
            'memberships' => [
                'rank:id,name,level',
                'player:id,name,level,vocation' => ['online'],
            ],
            'invites' => [
                'player:id,account_id,name,vocation,level'
            ],
        ])->first();

        $isOwner = Player::where('id', $guild->ownerid)
            ->where('account_id', Auth::id())
            ->exists();

        return view('guild.show', [
            'guild' => $guild,
            'isOwner' => $isOwner,
        ]);
    }

    public function create()
    {
        $characters = Player::where('account_id', Auth::id())->get(['id', 'name']);

        return view('guild.create', ['characters' => $characters]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['string', 'max:255', 'unique:guilds'],
            'ownerid' => [
                'int', 'unique:guilds',
                function (string $attribute, mixed $value, Closure $fail) {
                    if (
                        !Player::where('id', $value)
                            ->where('account_id', Auth::id())
                            ->exists()
                    ) {
                        $fail('This character does not belong to your account.');
                    }
                }
            ],
        ]);

        $guild = Guild::create([
            'name' => $request->name,
            'ownerid' => $request->ownerid,
        ]);

        GuildMembership::create([
            'player_id' => $request->ownerid,
            'guild_id' => $guild->id,
            'rank_id' => $guild->ranks[0]->id, // First rank created by SQL trigger is always the Leader.
        ]);

        return redirect()->route('guild.show', ['id' => $guild->id]);
    }

    public function showInviteForm(int $id)
    {
        $guild = Guild::findOrFail($id)->first();

        return view('guild.invite', ['guild' => $guild]);
    }

    public function invite(int $id, Request $request): RedirectResponse
    {
        $request->validate([
            'player_name' => ['string', 'max:32', 'required'],
        ]);

        $player = Player::where('name', $request->player_name)->get('id')->first();

        if (!$player) {
            return back()->withErrors(['name' => 'Could not find player.']);
        }

        if ($player->membership()->count() > 0) {
            return back()->withErrors(['invite' => 'Player is already in a guild.']);
        }

        if (
            GuildInvite::where('player_id', $player->id)
            ->where('guild_id', $id)
            ->exists()
        ) {
            return back()->withErrors(['invite' => 'Player is already invited.']);
        }

        GuildInvite::create([
            'player_id' => $player->id,
            'guild_id' => $id,
        ]);

        return back();
    }

    public function acceptInvite(Request $request, int $guildId, int $playerId): RedirectResponse
    {
        if (!$request->user()->hasCharacter($playerId)) {
            return abort(404);
        }

        if (
            !GuildInvite::where('player_id', $playerId)
                ->where('guild_id', $guildId)
                ->exists()
        ) {
            return abort(404);
        }

        $guild = Guild::findOrFail($guildId);

        GuildInvite::where('player_id', $playerId)->delete();

        GuildMembership::create([
            'player_id' => $playerId,
            'guild_id' => $guildId,
            'rank_id' => $guild->lowestRank()->id,
        ]);

        return back();
    }

    public function cancelInvite(Request $request, int $guildId, int $playerId): RedirectResponse
    {
        $account = $request->user();

        if (!$account->hasCharacter($playerId) && !$account->hasGuildOwner($guildId)) {
            return abort(404);
        }

        $invite = GuildInvite::where('player_id', $playerId)
            ->where('guild_id', $guildId);

        if (!$invite->exists()) {
            return abort(404);
        }

        $invite->delete();

        return back();
    }

    public function kick(Request $request, int $playerId)
    {
        $player = Player::findOrFail($playerId);

        if ($player->membership()->count() == 0) {
            return abort(404);
        }

        if ($player->membership->rank->level == $player->membership->guild->highestRank()->level) {
            return back()->withErrors(['rank' => 'You cannot kick the highest rank.']);
        }

        $player->membership()->delete();

        return back();
    }
}
