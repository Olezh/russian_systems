<?php
/**
 * Created by PhpStorm.
 * User: Ol
 * Date: 25.08.2019
 * Time: 6:13
 */

namespace app\controllers;


use app\models\Comment;

class Api
{
    public function actionDefault()
    {
        if(empty($_POST['parent_id'])) {
            $_POST['parent_id'] = null;
        }

        $comment = new Comment();
        $comment->fill($_POST);
        $comment->save();
        echo $comment->id;
    }
}