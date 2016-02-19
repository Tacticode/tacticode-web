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
        return $this->BelongsTo('App\Http\Models\Power');
    }
}
}
