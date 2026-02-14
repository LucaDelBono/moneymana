<?php

class HomeController {
    public function loginPage(){
        require __DIR__ . '/../public/view/login.php';
    }

    public function registerPage(){
        require __DIR__ . '/../public/view/register.php';
    }

    public function homePage(){
        require __DIR__ . '/../public/view/user/home.php';
    }

    public function historyPage(){
        require __DIR__ . '/../public/view/user/history.php';
    }

    public function historyYearPage(){
        require __DIR__ . '/../public/view/user/history_year.php';
    }

    public function settingsPage(){
        require __DIR__ . '/../public/view/user/settings.php';
    }

    public function errorPage(){
        require __DIR__ .  '/../public/view/404.php';
    }
}