<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guild extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'ownerid'];

    protected $dateFormat = 'U';

    const CREATED_AT = 'creationdata';

    const UPDATED_AT = null;

    protected function members(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->memberships->sortByDesc(function (GuildMembership $membership) {
                return $membership->rank->level;
            })->map(function (GuildMembership $membership) {
                return $membership->player;
            })
        );
    }

    public function invites(): HasMany
    {
        return $this->hasMany(GuildInvite::class);
    }

    public function memberships(): HasMany
    {
        return $this->hasMany(GuildMembership::class);
    }

    public function ranks(): HasMany
    {
        return $this->hasMany(GuildRank::class);
    }

    public function lowestRank(): GuildRank
    {
        return $this->ranks->sortBy('level')->first();
    }

    public function highestRank(): GuildRank
    {
        return $this->ranks->sortByDesc('level')->first();
    }
}
