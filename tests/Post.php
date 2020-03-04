<?php

namespace MadWeb\Enum\Test;

use Illuminate\Database\Eloquent\Model;
use MadWeb\Enum\EnumCastable;

class Post extends Model
{
    use EnumCastable;

    public $timestamps = false;

    protected $fillable = ['title', 'status'];

    protected $casts = [
        'status' => PostStatusEnum::class,
    ];
}
