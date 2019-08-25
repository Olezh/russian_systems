<?php
/**
 * Created by PhpStorm.
 * User: Ol
 * Date: 25.08.2019
 * Time: 17:29
 */

namespace app\controllers;


class Home
{
    public function actionDefault()
    {
        include(__DIR__ . '/../../templates/home.html');
    }

}