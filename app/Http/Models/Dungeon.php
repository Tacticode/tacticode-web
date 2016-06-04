<?php

namespace App\Http\Models;

use App\Http\Models\User;
use Illuminate\Database\Eloquent\Model;

class Dungeon extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'dungeons';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'user_id', 'level_min', 'level_max', 'map'];

    /**
    * A dungeon can belong to a user.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    *
    */
    public function user()
    {
        return $this->belongsTo('App\Http\Models\User');
    }
}
