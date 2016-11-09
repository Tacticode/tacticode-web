<?php

namespace App\Http\Models;

use App\Http\Models\User;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'chats';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['message', 'user_id'];

    /**
    * A chat message has a user.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    *
    */
    public function user()
    {
        return $this->belongsTo('App\Http\Models\User');
    }
}
