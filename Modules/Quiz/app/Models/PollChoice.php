<?php

namespace Modules\Quiz\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Quiz\Database\Factories\PollChoiceFactory;

class PollChoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name', 'poll_id', 'votes'
    ];

    // protected static function newFactory(): PollChoiceFactory
    // {
    //     // return PollChoiceFactory::new();
    // }
}
