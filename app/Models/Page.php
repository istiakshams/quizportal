<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;

class Page extends Model implements Sitemapable
{
    use HasFactory;

    protected $guarded  = ['id'];


    public function toSitemapTag(): Url | string | array
    {
        if( $this->slug == 'home-page' ) {
            return '';
        }
        if( $this->status != 'draft' ) {
            return Url::create(route('home.pages.show', $this->slug))
            ->setLastModificationDate(Carbon::create($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1);
        }

        return '';
    }
}
