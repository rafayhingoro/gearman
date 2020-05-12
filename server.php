<?php
// debug On
ini_set('display_errors', -1);

// require server
require_once('./CustomServer.php');

// initialize server instance
$server = new CustomServer;

// add some work
$a = $server->addWork('random', function($job){
    $fn = ['bin2hex', 'strrev', 'strtoupper', 'strtolower', 'str_shuffle'];
    shuffle($fn);
    return call_user_func($fn[0], $job->workload());
});

// add some more work
$a = $server->addWork('randomtoken', function($job){
    if( is_string($data) && $data = unserialize( $job->workload() ) ) {
        if(isset($data['hash']) && isset($data['hashtype']) && isset($data['string'])) {
            return hash($data['hashtype'], $data['string']);
        } else {
            return hash('sha1', rand(0000,9999));
        }
    } else {
        return rand(0000, 9999);
    }
});

// execute server
$server->run();
