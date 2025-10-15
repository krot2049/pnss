<?php

use Src\Route;

Route::add('go', [Controller\Site::class, 'index']);
Route::add('hello', [Controller\Site::class, 'hello']);

class Site {
    public function index() : void {
        echo 'working index';
    }
    public function hello() : void {
        echo 'working hello';
    }
}