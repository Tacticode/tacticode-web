<?php

namespace App;

use App\Http\Models\Character;

use Illuminate\Database\Eloquent\Model;

class Class extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'classes';

    /**
    * A class has many character.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    *
    */
    public function character()
    {
        return $this->hasMany('Character');
    }
}
