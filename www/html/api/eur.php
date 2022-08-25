<?php

require '../../vendor/autoload.php';


use App\View\ApiEndpoints\DemoEndpoint;




$homeController = new DemoEndpoint();
if (key_exists('type', $_GET)) {
    $type = $_GET['type'];
    $homeController->renderAction($type);
} else {
    $homeController->renderAction();
}
