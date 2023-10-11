<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\Guild;
use App\Models\Player;
use Illuminate\Auth\Access\Response;

class GuildPolicy
{
    /**
     * Determine if the user can invite the given player.
     */
    public function invite(Account $account, Guild $guild, ?Player $player): Response
    {
        if (!$player) {
            return Response::deny('Player not found.');
        }

        if (!$account->hasGuildOwner($guild)) {
            return Response::deny('You are not the guild owner.');
        }

        if ($player->membership()->count() > 0) {
            return Response::deny('Player already have a guild.');
        }

        if ($guild->hasInvite($player->id)) {
            return Response::deny('Player already invited.');
        }

        return Response::allow();
    }

    /**
     * Determine if the user can accept the invite.
     */
    public function acceptInvite(Account $account, Guild $guild, Player $player): bool
    {
        return $account->hasCharacter($player) && $guild->hasInvite($player->id);
    }

    public function cancelInvite(Account $account, Guild $guild, Player $player): bool
    {
        return $guild->hasInvite($player->id) && ($account->hasGuildOwner($guild) || $account->hasCharacter($player));
    }

    /**
     * Determine if the given player can be kicked by the user.
     */
    public function kick(Account $account, Guild $guild, Player $player): bool
    {
        return $account->hasGuildOwner($guild) && $player->id !== $guild->ownerid;
    }
}
