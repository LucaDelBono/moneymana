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
require_once "controller/MonthController.php";
require_once "controller/YearController.php";
require_once "controller/ExpenseController.php";
require_once "model/UserModel.php";
require_once "model/MonthModel.php";
require_once "model/YearModel.php";
require_once "model/ExpenseModel.php";
require_once "entity/User.php";
require_once "entity/Year.php";
require_once "entity/Month.php";
require_once "entity/Expense.php";

CONST MONTHS = [
    "1" => "1", 
    "2" => "2",
    "3" => "3",
    "4" => "4",
    "5" => "5",
    "6" => "6",
    "7" => "7",
    "8" => "8",
    "9" => "9", 
    "10" => "10",
    "11" => "11",
    "12" => "12"
];

CONST YEARS = [
    "2021" => "1", 
    "2022" => "2",
    "2023" => "3",
    "2024" => "4",
    "2025" => "5",
    "2026" => "6"
];