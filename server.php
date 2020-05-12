<?php
// debug On
ini_set('display_errors', -1);

// require server
require_once('./CustomServer.php');

// initialize server instance
$server = new CustomServer;

// add some work
$a = $server->addWork('random', function($job){
    $fn = ['strrev', 'strtoupper', 'strtolower', 'str_shuffle'];
    shuffle($fn);
    return call_user_func($fn[0], $job->workload());
});

// execute server
$server->run();
