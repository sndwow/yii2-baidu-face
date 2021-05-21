<?php

require_once ('vendor/autoload.php');
/**
 *
 * author: WCY
 * date: 2020/02/10 9:26 PM
 * version: 1.0
 */
use yii\helpers\ArrayHelper;
use yii\helpers\Json;


class a {
    public $c = 2;
    public $v ='2';
    public $z = false;
    const Cuu =1;
}

$a = new a();

echo Json::encode(ArrayHelper::toArray($a));
