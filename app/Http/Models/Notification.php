<?php

namespace App\Http\Models;

use App\Http\Models\User;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'notifications';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'title', 'content', 'seen', 'date'];

    /**
    * A message has a user.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    *
    */
    public function user()
    {
        return $this->belongsTo('App\Http\Models\User');
    }
}
