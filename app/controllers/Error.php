<?php
/**
 * Created by PhpStorm.
 * User: Ol
 * Date: 25.08.2019
 * Time: 17:33
 */

namespace app\controllers;


class Error
{
    public function actionDefault($message)
    {
        include(__DIR__ . '/../../templates/error.html');
    }

}