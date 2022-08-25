<?php

require '../vendor/autoload.php';


use App\View\ApiEndpoints\DemoEndpoint;

$homeController = new DemoEndpoint();
$homeController->renderAction();
