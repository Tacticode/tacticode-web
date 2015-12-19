<?php

namespace App;

use App\Http\Models\Character;

use Illuminate\Database\Eloquent\Model;

class Script extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'scripts';

    /**
    * A script has many character.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    *
    */
    public function character()
    {
        return $this->hasMany('Character');
    }
}
