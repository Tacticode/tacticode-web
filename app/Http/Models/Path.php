<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Path extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'paths';

    /**
    * A path contains two nodes.
    *
    * @return array
    *
    */
    public function node_f()
    {
        return $this->belongsTo('App\Http\Models\Node', 'node_from');
    }

    /**
    * A path contains two nodes.
    *
    * @return array
    *
    */
    public function node_t()
    {
        return $this->belongsTo('App\Http\Models\Node', 'node_to');
    }
}
