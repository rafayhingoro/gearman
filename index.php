<?php
ini_set('display_errors', -1);

$client = new GearmanClient();
$client->addServer();

$client->setCompleteCallback('completed');

// multiple tasks assignment
for( $i = 0; $i < 5; $i++) {
    $client->addTask('random', 'boomerang', null, $i);
}

function completed(GearmanTask $task) {
    echo $task->data() .' - '. $task->unique() ."\n<br>"; 
}

$client->runTasks();
