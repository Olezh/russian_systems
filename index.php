<?php
/**
 * Created by PhpStorm.
 * User: Ol
 * Date: 25.08.2019
 * Time: 3:21
 */

require_once __DIR__ . '/autoload.php';

$topicName = $_GET['ID'] ?? 'Home';

//$conf = new \app\Config();

//$db = \app\Db::instance();


$result =  (new \app\models\Comment())::getAlltItems();

var_dump($result);

$comm = new \app\models\Comment();

$comm->fill([
    'parent_id' => 3,
    'body' => 'super good 3'
]);

$comm->save();

$result =  (new \app\models\Comment())::getAlltItems();

var_dump($result);

//var_dump($conf);