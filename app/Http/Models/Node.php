<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'nodes';

    /**
    * A node belongs to a power.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    *
    */
    public function power()
    {
        return $this->belongsTo('App\Http\Models\Power');
    }

    /**
    * A node belongs to multiple characters.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    *
    */
    public function character()
    {
        return $this->belongsToMany('App\Http\Models\Character');
    }

    /**
    * A node has many paths.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    *
    */
    public function path_from()
    {
        return $this->hasMany('App\Http\Models\Path', 'node_from');
    }

    /**
    * A node has many paths.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    *
    */
    public function path_to()
    {
        return $this->hasMany('App\Http\Models\Path', 'node_to');
    }
}
