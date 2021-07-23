<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kangaroo extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];
    
    const UNKNOWN = 0;
    const MALE = 1;
    const FEMALE = 2;

    const GENDER = [
        self::UNKNOWN => "Unknown",
        self::MALE => "Male",
        self::FEMALE => "Female"
    ];

    const UNFRIENDLY = 0;
    const FRIENDLY = 1;

    const FRIENDLINESS = [
        [
            'id' => self::UNFRIENDLY,
            'name' => 'Unfriendly'
        ],
        [
            'id' => self::FRIENDLY,
            'name' => 'Friendly'
        ],
    ];

}
