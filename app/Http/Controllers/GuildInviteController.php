<?php

namespace App\Http\Controllers;

use App\Http\Requests\Guild\InviteRequest;
use App\Models\Guild;
use App\Models\Player;
use App\Services\GuildInviteService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class GuildInviteController extends Controller
{
    public function __construct(private GuildInviteService $guildInviteService)
    {
    }

    public function showInviteForm(Guild $guild): View
    {
        return view('guild.invite', compact('guild'));
    }

    public function invite(InviteRequest $request, Guild $guild): RedirectResponse
    {
        $this->authorize('own', $guild);

        $player = Player::where('name', $request->player_name)->first();

        try {
            $this->authorize('invite', [$guild, $player]);
        } catch (AuthorizationException $error) {
            return back()->withErrors(['message' => $error->getMessage()]);
        }

        $this->guildInviteService->createInvite($guild, $player);

        return back();
    }

    public function kick(Guild $guild, Player $player): RedirectResponse
    {
        $this->authorize('kick', [$guild, $player]);

        $player->membership()->delete();

        return back();
    }

    public function accept(Guild $guild, Player $player): RedirectResponse
    {
        $this->authorize('acceptInvite', [$guild, $player]);

        $this->guildInviteService->acceptInvite($guild, $player);

        return back();
    }

    public function cancel(Guild $guild, Player $player): RedirectResponse
    {
        $this->authorize('cancelInvite', [$guild, $player]);

        $this->guildInviteService->cancelInvite($guild, $player);

        return back();
    }
}
