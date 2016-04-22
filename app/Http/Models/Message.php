<?php

namespace App\Http\Models;

use App\Http\Models\User;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messages';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content', 'object'];

    /**
    * A message has multiple users.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    *
    */
    public function user()
    {
        return $this->belongsToMany('App\Http\Models\User')->withTimestamps()->withPivot('type', 'seen');
    }
}
