<?php

namespace App\Repositories;

use App\Enums\SkillTypeEnum;
use App\Models\Player;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class PlayerRepository
{
    public function getHighscorePlayers(int $skillType): Collection
    {
        $skill = match ($skillType) {
            SkillTypeEnum::MAGLEVEL->value  => "maglevel",
            SkillTypeEnum::FIST->value      => "skill_fist",
            SkillTypeEnum::CLUB->value      => "skill_club",
            SkillTypeEnum::SWORD->value     => "skill_sword",
            SkillTypeEnum::AXE->value       => "skill_axe",
            SkillTypeEnum::DIST->value      => "skill_shielding",
            SkillTypeEnum::SHIELDING->value => "skill_shielding",
            SkillTypeEnum::FISHING->value   => "skill_fishing",
            default                         => "level",
        };

        $players = Player::orderByDesc($skill)
            ->select('name', 'vocation', DB::raw("$skill as skill"))
            ->take(50)
            ->get();

        return $players;
    }

    public function getPlayersOnline(): Collection
    {
        $players = Player::join('players_online', 'players.id', '=', 'players_online.player_id')
            ->select('id', 'name', 'vocation', 'level')
            ->orderByDesc('level')
            ->get();

        return $players;
    }
}
