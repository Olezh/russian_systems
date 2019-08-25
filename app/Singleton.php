<?php
/**
 * Created by PhpStorm.
 * User: Ol
 * Date: 25.08.2019
 * Time: 3:42
 */

namespace app;


trait Singleton
{
    protected static $instance = null;
    protected function __construct()
    {
    }
    public static function instance()
    {
        if (null === static::$instance) {
            static::$instance = new static;
        }
        return static::$instance;
    }

}