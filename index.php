<?php
ini_set('display_errors', -1);

$client = new GearmanClient();
$client->addServer();

echo $client->do('random', 'boomerang');