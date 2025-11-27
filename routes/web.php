<?php
use Src\Route;
use App\Controller\Site;

Route::add('', [Site::class, 'index']);
Route::add('hello', [Site::class, 'hello']);
Route::add('go', [Site::class, 'go']);