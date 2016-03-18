<?php

namespace App\Http\Models;

use App\Http\Models\Group;
use App\Http\Models\Character;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['login', 'email', 'password', 'group_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password'/*, 'remember_token'*/];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = \Hash::make($password);
    }

    /**
    * An user is in a group.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    *
    */
    public function group()
    {
        return $this->belongsTo('App\Http\Models\Group');
    }

    /**
    * A user has many characters.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    *
    */
    public function character()
    {
        return $this->hasMany('App\Http\Models\Character');
    }

    /**
    * A user has many fights.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    *
    */
    public function fight()
    {
        return $this->hasManyThrough('App\Http\Models\Fight', 'App\Http\Models\Character');
    }

    /**
    * A user has many scripts.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    *
    */
    public function script()
    {
        return $this->hasMany('App\Http\Models\Script');
    }

    /**
    * A user has many teams.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    *
    */
    public function team()
    {
        return $this->hasMany('App\Http\Models\Team');
    }
}
