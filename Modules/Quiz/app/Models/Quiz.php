<?php

namespace Modules\Quiz\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Quiz\Database\Factories\QuizFactory;

class Quiz extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];

    /**
     * Boot Method
     *
     */
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($quiz) {
            $quiz->questions()->delete();
        });
    }

    public function category()
    {
        return $this->belongsTo('Modules\Quiz\Models\QuizCategory');
    }

    public function questions()
    {
        return $this->hasMany('Modules\Quiz\Models\Question');
    }
}
