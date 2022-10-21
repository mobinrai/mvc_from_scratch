<?php

use app\controllers\AuthController;
use core\Router;
use app\controllers\HomeController;

Router::get('/', [HomeController::class, 'index']);
Router::get('/contact', [HomeController::class, 'contact']);
Router::post('/submit_contact', [HomeController::class, 'postContact']);
Router::get('/about', [HomeController::class, 'about']);


Router::get('/login', [AuthController::class, 'login']);
Router::post('/login', [AuthController::class, 'checkCrediential']);
Router::get('/register', [AuthController::class, 'register']);
Router::post('/register', [AuthController::class, 'addCrediential']);