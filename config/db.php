<?php
    // локальный сайт
    if ($_SERVER['HTTP_HOST'] == "champion-lk.os") 
        return [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=champion-lk',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ];
    // продакшн
    elseif ($_SERVER['HTTP_HOST'] == "lk.championdd.ru") 
        return [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=u0324545_lk',
            'username' => 'u0324545_default',
            'password' => 'Qc_andB0',
            'charset' => 'utf8',
        ];
    else {
        echo 'Неверная конфигурация. ' . $_SERVER['HTTP_HOST'];
        exit(0);
    }