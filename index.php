<?php
/**
 * Created by PhpStorm.
 * User: Ol
 * Date: 25.08.2019
 * Time: 3:21
 */

require_once __DIR__ . '/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller = new \app\controllers\Api();
} elseif(isset($_GET['ID'])) {
    $controller = new \app\controllers\Comments();
} else {
    $controller = new \app\controllers\Home();
}

try {
    $controller->actionDefault();
} catch (\Exception $e) {
    (new \app\Controllers\Error())->actionDefault($e->getMessage());
}