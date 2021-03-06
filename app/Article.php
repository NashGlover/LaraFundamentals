<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Article extends Model
{
    protected $fillable = [
    	'title',
    	'body', 
    	'published_at',
    ];

    protected $dates = ['published_at'];

    public function scopePublished($query)
    {
    	$query->where('published_at', '<=', Carbon::now());
    }

    /**
     * Scope queries to articles that have been published.
     * 
     * @param  $query
     */
    public function scopeUnpublished($query)
    {
    	$query->where('published_at', '>', Carbon::now());
    }
    /**
     * Set the published_at attribute.
     * 
     * @param $date
     */
    public function setPublishedAtAttribute($date)
    {
    	$this->attributes['published_at'] = Carbon::parse($date);
    }

    /**
     * An article is owned by a user.
     * 
     * @return \Illumiante\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');   
    }
}
