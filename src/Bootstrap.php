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
    "January" => "0", 
    "February" => "1",
    "March" => "2",
    "April" => "3",
    "May" => "4",
    "June" => "5",
    "July" => "6",
    "August" => "7",
    "September" => "8", 
    "October" => "9",
    "November" => "10",
    "December" => "11"
];

CONST YEARS = [
    "2021" => "0", 
    "2022" => "1",
    "2023" => "2",
    "2024" => "3",
    "2025" => "4",
    "2026" => "5"
];