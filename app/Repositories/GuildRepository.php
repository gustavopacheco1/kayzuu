<?php

namespace App\Repositories;

use App\Models\Guild;

class GuildRepository
{
    public function getGuildDetails(Guild $guild): Guild
    {
        return $guild->with([
            'memberships' => [
                'rank:id,name,level',
                'player:id,name,level,vocation' => ['online'],
            ],
            'invites' => [
                'player:id,account_id,name,vocation,level'
            ],
        ])->first();
    }
}
