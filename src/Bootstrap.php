<?php

define("CONTAINER_NAME_DB", getenv("CONTAINER_NAME_DB"));
define("MYSQL_USER", getenv("MYSQL_USER"));
define("MYSQL_PASSWORD", getenv("MYSQL_PASSWORD"));
define("MYSQL_DATABASE", getenv("MYSQL_DATABASE"));

require_once "Function.php";
require_once "database/Database.php";
require_once "controller/AuthController.php";
require_once "controller/HomeController.php";
require_once "controller/UserController.php";
require_once "model/UserModel.php";
require_once "entity/User.php";