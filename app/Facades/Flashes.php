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

    	Session::push('flashes', ['type' => $type, 'message' => $message]);
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
    	return $flashes;
    }
}