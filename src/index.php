<?php
require_once './Router.php';
require_once './Bootstrap.php';
$router = new Router();

$viewDir = 'public/view/';
$ajaxDir = 'ajax/';

//auth
$router->get('/', [HomeController::class, 'loginPage']);
$router->get('/accedi', [HomeController::class, 'loginPage']);
$router->post('/accedi', [AuthController::class, 'login']);
$router->get('/logout', [AuthController::class, 'logout']);
$router->get('/registrazione', [HomeController::class, 'registerPage']);
$router->post('/registrazione', [UserController::class, 'insert']);

//user
$router->get('/user/home', [HomeController::class, 'homePage']);
$router->get('/user/storico', [HomeController::class, 'historyPage']);
$router->get('/user/storico_anno', [HomeController::class, 'historyYearPage']);
$router->get('/user/impostazioni', [HomeController::class, 'settingsPage']);

$router->get('/404', [HomeController::class, 'errorPage']);

$router->resolve();
