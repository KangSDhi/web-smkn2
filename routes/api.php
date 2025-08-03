<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController as Auth;
use App\Http\Controllers\API\ArticleController as Article;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/login', [Auth::class, 'login']);

Route::middleware('jwt')->group(function(){
    Route::get('/user', [Auth::class, 'getUser']);
});

Route::middleware(['jwt', 'role:author'])->prefix('author')->group(function(){
    Route::get('/user', [Auth::class, 'getUser']);
    Route::get('/articles', [Article::class, 'getArticles']);
    Route::get('/articles/limit/{limit}', [Article::class, 'getArticlesLimit']);
    Route::get('/articles/user/{id}', [Article::class, 'getArticlesByUserId']);
    Route::post('/article', [Article::class, 'storeArticle']);
    Route::put('/article/{id}', [Article::class, 'updateArticle']);
    Route::delete('/article/{id}', [Article::class, 'deleteArticle']);
});
