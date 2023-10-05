<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    protected $dateFormat = 'U';

    const CREATED_AT = 'creation';

    const UPDATED_AT = null;

    public function characters(): HasMany
    {
        return $this->hasMany(Player::class);
    }

    public function hasCharacter(int $playerId): bool
    {
        return $this->characters->contains($playerId);
    }

    public function hasGuildOwner(int $guildId): bool
    {
        $guild = Guild::find($guildId);

        return $this->characters->contains($guild->ownerid);
    }
}
