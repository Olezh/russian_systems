<?php
/**
 * Created by PhpStorm.
 * User: Ol
 * Date: 25.08.2019
 * Time: 4:59
 */

namespace app\controllers;


use app\models\Comment;

class Comments
{
    public $comments = [];
    public $tree= '';


    public function actionDefault()
    {
        foreach (Comment::entityGenerator($_GET['ID']) as $item){
            $parent = $item->parent_id ?? 'root';
            $this->comments[$parent][] = $item;
        }

        if(empty($this->comments)){
            throw new \Exception('Page not found');
        }

        $this->buildTree();

        include(__DIR__ . '/../../templates/default.html');
    }

    public function buildTree($parent = 'root')
    {
        $ul = '<ul>';
        $lu = '</ul>';
        $li = '<li>';
        $il = '</li>';

        $this->tree .= $ul;

        foreach ($this->comments[$parent] as $item) {
            $this->tree .=  $li . $item->body;
            $this->tree .=  $this->form($item->id);
            if(isset($this->comments[$item->id])){
                $this->buildTree($item->id);
            }
            $this->tree .=  $il;
        }
        $this->tree .=  $lu;
    }

    public function form($id = null)
    {
        return '<div class="box">
                    <input type="text">
                    <button class="submit" data="' . $id . '" >Опубликовать</button>
                </div>';
    }

}