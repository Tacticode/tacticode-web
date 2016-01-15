<?php

namespace App\Http\Models;

use App\Http\Models\User;
use App\Http\Models\Classe;
use App\Http\Models\Script;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'characters';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'class_id', 'script_id'];

    /**
    * A character belong to a user.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    *
    */
    public function user()
    {
        return $this->belongsTo('App\Http\Models\User');
    }

    /**
    * A character belong to a class.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    *
    */
    public function classe()
    {
        return $this->belongsTo('App\Http\Models\Classe');
    }

    /**
    * A character has many scripts.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    *
    */
    public function script()
    {
        return $this->hasMany('App\Http\Models\Script');
    }
}