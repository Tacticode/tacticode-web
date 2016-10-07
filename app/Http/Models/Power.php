<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Power extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'powers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'type'];

    /**
    * A power has many nodes.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    *
    */
    public function node()
    {
        return $this->hasMany('App\Http\Models\Node');
    }
}
