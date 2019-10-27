<?php
$config = array(
    'title' => 'АРМ школа',
    'db' => array(
        'server' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'name' => 'eduplan'
    )
);

require 'rb-mysql.php';

$s =  "mysql:host=".$config['db']['server'].";dbname=".$config['db']['name'];

R::setup($s , $config['db']['username'],$config['db']['password'] );

if ( !R::testConnection() )
{
    exit ('Нет соединения с базой данных');
}

