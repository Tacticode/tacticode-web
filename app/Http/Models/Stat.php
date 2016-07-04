<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'stats';

    /**
     * Return the stats for the given level
     * Return the stats for the max level if no arguments are given
     *
     * @var int
     */
    public static function getByLevel($level = -1)
    {
    	$ret = [];
    	$stats = Stat::all()->keyBy('name');

    	if ($level < 0)
    	{
    		$level = $stats['LEVELMAX']['default'];
    	}
    	foreach ($stats as $stat)
    	{
    		$ret[$stat['name']] = $stat['default'] + $level * $stat['increase'];
    	}
    	return $ret;
    }

    /**
     * Return the stats for the max level
     *
     * @var int
     */
    public static function getMax()
    {
    	return Stat::getByLevel();
    }
}
