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
$router->get('/user/spese_mensili', [HomeController::class, 'monthlyExpensesPage']);
$router->get('/user/impostazioni', [HomeController::class, 'settingsPage']);
$router->post('/user/update', [UserController::class, 'update']);
$router->post('/user/update_password', [UserController::class, 'updatePassword']);
$router->post('/user/delete', [UserController::class, 'delete']);

//ajax
$router->post('/checkExistEmail', [UserController::class, 'checkExistEmailJson']);
$router->post('/checkExistUsername', [UserController::class, 'checkExistUsernameJson']);

$router->get('/error', [HomeController::class, 'errorPage']);

$router->resolve();
