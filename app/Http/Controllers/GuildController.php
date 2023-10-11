<?php

namespace App\Http\Controllers;

use App\Http\Requests\Guild\InviteAcceptRequest;
use App\Http\Requests\Guild\InviteCancelRequest;
use App\Http\Requests\Guild\KickRequest;
use App\Http\Requests\Guild\StoreRequest;
use App\Models\Account;
use App\Models\Guild;
use App\Models\GuildInvite;
use App\Models\GuildMembership;
use App\Models\Player;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GuildController extends Controller
{
    public function index(): View
    {
        $guilds = Guild::get(['id', 'name']);

        return view('guild.index', ['guilds' => $guilds]);
    }

    public function show(Guild $guild): View
    {
        $guild = $guild->with([
            'memberships' => [
                'rank:id,name,level',
                'player:id,name,level,vocation' => ['online'],
            ],
            'invites' => [
                'player:id,account_id,name,vocation,level'
            ],
        ])->first();

        /** @var Account $account */
        $account = auth()->user();

        $isOwner = $account->hasGuildOwner($guild);

        return view('guild.show', [
            'guild' => $guild,
            'isOwner' => $isOwner,
        ]);
    }

    public function create(): View
    {
        /** @var Account $account */
        $account = auth()->user();

        return view('guild.create', ['characters' => $account->characters]);
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $guild = Guild::create([
            'name' => $request->input('name'),
            'ownerid' => $request->input('ownerid'),
        ]);

        GuildMembership::create([
            'player_id' => $request->input('ownerid'),
            'guild_id' => $guild->id,
            'rank_id' => $guild->ranks[0]->id, // First rank created by SQL trigger is always the Leader.
        ]);

        return redirect()->route('guild.show', [$guild->id]);
    }

    public function showInviteForm(Guild $guild): View
    {
        return view('guild.invite', ['guild' => $guild]);
    }

    public function invite(Request $request, Guild $guild): RedirectResponse
    {
        try {
            $player = Player::where('name', $request->input('player_name'))->first();

            $this->authorize('invite', [$guild, $player]);

            GuildInvite::create([
                'player_id' => $player->id,
                'guild_id' => $guild->id,
            ]);

            return back();
        } catch (AuthorizationException $e) {
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function acceptInvite(InviteAcceptRequest $request, Guild $guild, Player $player): RedirectResponse
    {
        GuildInvite::where('player_id', $player->id)->delete();

        GuildMembership::create([
            'player_id' => $player->id,
            'guild_id' => $guild->id,
            'rank_id' => $guild->lowestRank()->id,
        ]);

        return back();
    }

    public function cancelInvite(InviteCancelRequest $request, Guild $guild, Player $player): RedirectResponse
    {
        GuildInvite::where('player_id', $player->id)
            ->where('guild_id', $guild->id)
            ->delete();

        return back();
    }

    public function kick(KickRequest $request, Guild $guild, Player $player): RedirectResponse
    {
        $player->membership()->delete();

        return back();
    }
}
