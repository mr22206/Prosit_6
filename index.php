<?php
/**
 * This is the router, the main entry point of the application.
 * It handles the routing and dispatches requests to the appropriate controller methods.
 */

require "vendor/autoload.php";

use App\Controllers\TaskController;

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
    'debug' => true
]);

if (isset($_GET['uri'])) {
    $uri = $_GET['uri'];
} else {
    $uri = '/';
}

$controller = new TaskController($twig);

switch ($uri) {
    case '/':
        $controller->welcomePage();
        break;
    case 'add_task':
        $controller->addTask();
        break;
    case 'check_task':
        $controller->checkTask();
        break;
    case 'history':
        $controller->historyPage();
        break;
    case 'uncheck_task':
        $controller->uncheckTask();
        break;
    case 'about':
        $controller->aboutPage();
        break;
    default:
        header("HTTP/1.0 404 Not Found");
        echo '404 Not Found';
        break;
}