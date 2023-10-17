<?php

namespace App\Services;

use App\Models\Guild;
use App\Models\GuildInvite;
use App\Models\GuildMembership;
use App\Models\Player;

class GuildInviteService
{
    public function createInvite(Guild $guild, Player $player): GuildInvite
    {
        return GuildInvite::create([
            'player_id' => $player->id,
            'guild_id' => $guild->id,
        ]);
    }

    public function acceptInvite(Guild $guild, Player $player): void
    {
        GuildInvite::where('player_id', $player->id)->delete();

        GuildMembership::create([
            'player_id' => $player->id,
            'guild_id' => $guild->id,
            'rank_id' => $guild->lowestRank()->id,
        ]);
    }

    public function cancelInvite(Guild $guild, Player $player): void
    {
        GuildInvite::where('player_id', $player->id)
                ->where('guild_id', $guild->id)
                ->delete();
    }
}
