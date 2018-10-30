<?php

namespace MadWeb\Enum\Test;

use MadWeb\Enum\EnumCastable;
use Illuminate\Database\Eloquent\Model;

class FavoriteDay extends Model
{
    use EnumCastable;

    public $timestamps = false;

    protected $fillable = ['title', 'day'];

    protected $casts = [
        'day' => DaysOfWeekEnum::class,
    ];
}
