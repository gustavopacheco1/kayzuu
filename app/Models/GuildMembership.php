<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GuildMembership extends Model
{
    use HasFactory;

    protected $table = 'guild_membership';

    protected $fillable = ['player_id', 'guild_id', 'rank_id'];

    public $timestamps = false;

    public function guild(): BelongsTo
    {
        return $this->belongsTo(Guild::class);
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function rank(): BelongsTo
    {
        return $this->belongsTo(GuildRank::class);
    }
}
