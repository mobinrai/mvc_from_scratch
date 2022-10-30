<?php

use app\controllers\AuthController;
use app\controllers\CategoryController;
use core\Router;
use app\controllers\HomeController;

Router::get('/', [HomeController::class, 'index']);
Router::get('/about', [HomeController::class, 'about']);
Router::get('/resume', [HomeController::class, 'resume']);
Router::get('/blog', [HomeController::class, 'blog']);
Router::get('/tutorials/{slug:[a-zA-Z_-]+}', [CategoryController::class, 'category']);
Router::get('/contact', [HomeController::class, 'contact']);
Router::post('/submit_contact', [HomeController::class, 'postContact']);

Router::get('/login', [AuthController::class, 'login']);
Router::get('/logout', [AuthController::class, 'logout']);
Router::post('/login', [AuthController::class, 'checkCrediential']);
Router::get('/register', [AuthController::class, 'register']);
Router::post('/register', [AuthController::class, 'addCrediential']);