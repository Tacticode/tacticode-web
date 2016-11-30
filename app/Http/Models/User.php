<?php

namespace App\Http\Models;

use App\Http\Models\Group;
use App\Http\Models\Character;
use App\Http\Models\Dungeon;

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
    * Get the global elo of all the users
    *
    * @return \Illuminate\Database\Eloquent\Collection
    */
    public static function getElo()
    {
        $users = User::all()->lists('id')->toArray();
        //Si quelqu'un veut s'amuser, voici la query à mettre en ORM si on veut le faire en 1 requête
        //SELECT id, SUM(elo) as elo FROM (SELECT users.id as id, characters.elo as elo FROM users LEFT JOIN characters ON characters.user_id = users.id UNION ALL SELECT users.id as id, teams.elo as elo FROM users LEFT JOIN teams ON teams.user_id = users.id) as tmp GROUP BY id
        $characters = User::join('characters', 'characters.user_id', '=', 'users.id')
        ->selectRaw('users.id, SUM(characters.elo) as elo')
        ->groupBy('users.id')
        ->lists('elo', 'users.id')->toArray();
        $teams = User::join('teams', 'teams.user_id', '=', 'users.id')
        ->selectRaw('users.id, SUM(teams.elo) as elo')
        ->groupBy('users.id')
        ->lists('elo', 'users.id')->toArray();

        $global = [];
        $solo = [];
        $team = [];
        foreach ($users as $id)
        {
            $solo[$id] = intval(isset($characters[$id]) ? $characters[$id] : 0);
            $team[$id] = intval(isset($teams[$id]) ? $teams[$id] : 0);
            $global[$id] = $solo[$id] + $team[$id];
        }
        arsort($solo);
        arsort($team);
        arsort($global);
        return ['solo' => $solo, 'team' => $team, 'global' => $global];
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
    * A user has multiple messages.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    *
    */
    public function message()
    {
        return $this->belongsToMany('App\Http\Models\Message')->withTimestamps()->withPivot('type', 'seen', 'deleted');
    }

    /**
    * A user has many notifications.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    *
    */
    public function notification()
    {
        return $this->hasMany('App\Http\Models\Notification')->orderBy('date', 'desc');
    }

    /**
    * Return recents notifications
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    *
    */
    public function recentNotification()
    {
        return $this->hasMany('App\Http\Models\Notification')->orderBy('date', 'desc')->limit(5);
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

    /**
    * A user has many dungeons.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    *
    */
    public function dungeon()
    {
        return $this->hasMany('App\Http\Models\Dungeon');
    }

    /**
    * A user has one tutorial.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasOne
    *
    */
    public function tutorial()
    {
        return $this->belongsTo('App\Http\Models\Tutorial');
    }
}
