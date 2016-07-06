<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use Session;

class Flashes extends Facade
{

	/**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {

    	return 'flashes';
    }

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function push($type, $message) {

        $flashes = Session::get('flashes');
        if (!is_array($flahes))
            $flashes = [];
        $flashes[] = ['type' => $type, 'message' => $message];
    	Session::set('flashes', $flashes);
    }

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function get($delete = true) {

    	$flashes = Session::get('flashes');
    	if ($delete)
    		Session::set('flashes', []);
        if (!is_array($flashes))
            $flashes = [];
    	return $flashes;
    }
}