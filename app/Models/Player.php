<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Player extends Model
{
    use HasFactory;

    protected $fillable = ['account_id', 'name', 'vocation', 'sex'];

    public $timestamps = false;

    protected function vocationName(): Attribute
    {
        $vocationId = $this->attributes['vocation'];

        return Attribute::make(
            get: fn () => config('tibia.vocations')[$vocationId]['name'] ?? 'none'
        );
    }

    public function online(): HasOne
    {
        return $this->hasOne(PlayerOnline::class);
    }

    public function membership(): HasOne
    {
        return $this->hasOne(GuildMembership::class);
    }
}
