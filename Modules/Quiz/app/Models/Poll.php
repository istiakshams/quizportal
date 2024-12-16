<?php

namespace Modules\Quiz\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poll extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [
        'id'
    ];    
    
    /**
     * Boot Method
     *
     */
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($poll) {
            $poll->choices->each(function ($choice) {
                Vote::where('choice_id', $choice->id)->delete();
            });
            $poll->choices()->delete();
        });
    }

    /**
     * A poll has many choices related to
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function choices()
    {
        return $this->hasMany(PollChoice::class);
    }

    /**
     * Get all of the votes for the poll.
     */
    public function votes()
    {
        return $this->hasManyThrough(Vote::class, Option::class);
    }

    /**
     * Check if the Guest has the right to vote
     *
     * @return bool
     */
    public function canGuestVote()
    {
        return $this->canVisitorsVote === 1;
    }
}
