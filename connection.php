<?php

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$host = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$database = substr($url["path"], 1);

$connection = mysqli_connect($host,$username,$password,$database) 
    or die('Error connecting to MySQL server.' . mysqli_error());

// $active_group = 'default';
// $query_builder = TRUE;
// $db['default'] = array(
//     'dsn' => '',
//     'hostname' => 'us-cdbr-east-02.cleardb.com',
//     'username' => 'b1fdba9afd03af',
//     'password' => 'dd0a8f5d',
//     'database' => 'heroku_881116d52ad8720',
//     'dbdriver' => 'myslqi',
//     'dbprefix' => '',
//     'pconnect' => FALSE,
//     'db_debug' => (ENVIRONMENT !== 'production'),
//     'cache_on' => FALSE,
//     'cachedir' => '',
//     'char_set' => 'utf8',
//     'dbcollat' => 'utf8_general_ci',
//     'swap_pre' => '',
//     'encrypt' => FALSE,
//     'compress' => FALSE,
//     'striction' => FALSE,
//     'failover' => array(),
//     'save_queries' => TRUE
// )

?>