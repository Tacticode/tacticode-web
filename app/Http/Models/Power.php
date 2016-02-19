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
    * A power belongs to many characters.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    *
    */
    public function character()
    {
        return $this->BelongsToMany('App\Http\Models\Character');
    }

    /**
    * A power has many nodes.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    *
    */
    public function node()
    {
        return $this->HasMany('App\Http\Models\Node');
    }
}
