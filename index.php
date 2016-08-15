<?php

require __DIR__ . "/vendor/autoload.php";

$app = new \Slim\Slim();

include __DIR__."/deps.php";
include __DIR__."/routes.php";

$app->run();
