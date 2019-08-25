<?php
/**
 * Created by PhpStorm.
 * User: Ol
 * Date: 25.08.2019
 * Time: 3:41
 */

namespace app;


class Config
{
    use Singleton;
    public $data = [];
    protected $path = __DIR__ . '/config';
    /**
     * Config constructor.
     * записывает массив параметров из \config\parameters.json в свойство $data
     */
    public function __construct()
    {
        foreach (scandir($this->path) as $filename) {
            $path = $this->path . '/' . $filename;
            if (is_file($path)) {
                $arr = require_once $path;
                $this->data += is_array($arr) ? $arr : [];
            }
        }
    }

}