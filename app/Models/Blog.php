<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;

use App\Models\User;

class Blog extends Model implements Sitemapable
{
    use HasFactory;

    protected $guarded  = ['id'];

    public function categories()
    {
        return $this->belongsToMany('App\Models\BlogCategory');
    }

    public function author()
    {
        $user = User::findOrFail($this->author_id);
        return $user->name;
    }

    public function toSitemapTag(): Url | string | array
    {
        if( $this->status != 'draft' ) {
            return Url::create(route('blog.show', $this->slug))
            ->setLastModificationDate(Carbon::create($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1);
        }

        return '';
    }
}
