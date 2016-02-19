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
    public function nodes()
    {
        return array('from' => $this->belongsTo('App\Http\Models\Node', 'node_from'), 'to' => $this->belongsTo('App\Http\Models\Node', 'node_to'));
    }
}
