<?php

namespace App\Services;

use App\Models\Guild;
use App\Models\GuildMembership;

class GuildService
{
    public function createGuild(array $data): Guild
    {
        $guild = Guild::create($data);

        GuildMembership::create([
            'player_id' => $data["ownerid"],
            'guild_id' => $guild->id,
            'rank_id' => $guild->ranks[0]->id, // First rank created by SQL trigger is always the Leader.
        ]);

        return $guild;
    }
}
