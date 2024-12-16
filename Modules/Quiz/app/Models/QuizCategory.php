<?php

namespace Modules\Quiz\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Quiz\Database\Factories\QuizCategoryFactory;

class QuizCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];
    
    public function quizzes()
    {
        return $this->hasMany('Modules\Quiz\Models\Quiz', 'category_id', 'id');
    }
}
