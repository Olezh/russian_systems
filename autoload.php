<?php
/**
 * Created by PhpStorm.
 * User: Ol
 * Date: 25.08.2019
 * Time: 3:23
 */

spl_autoload_register(function ($class){
    require __DIR__ . '/' .  str_replace('\\', '/', $class) . '.php';
});