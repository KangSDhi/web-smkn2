<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController as Auth;
use App\Http\Controllers\API\ArticleController as Article;
use App\Http\Controllers\API\ImagesArticleController as ImagesArticle;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/login', [Auth::class, 'login']);
Route::get('/articles', [Article::class, 'getArticles']);
Route::get('/articles/limit/{limit}', [Article::class, 'getArticlesLimit']);
Route::get('/article/slug/{slug}', [Article::class, 'getArticleBySlug']);
Route::get('/images/article/article/{id}', [ImagesArticle::class, 'getImagesArticleByIdArticle']);

Route::middleware('jwt')->group(function(){
    Route::get('/user', [Auth::class, 'getUser']);
});

Route::middleware(['jwt', 'role:author'])->prefix('author')->group(function(){
    Route::get('/logout', [Auth::class, 'logout']);
    Route::get('/user', [Auth::class, 'getUser']);
    Route::get('/articles', [Article::class, 'getArticles']);
    Route::get('/articles/limit/{limit}', [Article::class, 'getArticlesLimit']);
    Route::get('/articles/user/{id}', [Article::class, 'getArticlesByUserId']);
    Route::get('/article/slug/{slug}', [Article::class, 'getArticleBySlug']);
    Route::get('/article/{id}', [Article::class, 'getArticleById']);
    Route::post('/article', [Article::class, 'storeArticle']);
    Route::put('/article/{id}', [Article::class, 'updateArticle']);
    Route::delete('/article/{id}', [Article::class, 'deleteArticle']);
    Route::get('/images/article/article/{id}', [ImagesArticle::class, 'getImagesArticleByIdArticle']);
    Route::post('/image/article', [ImagesArticle::class, 'storeImageArticle']);
    Route::post('/images/article', [ImagesArticle::class, 'storeBatchImages']);
    Route::put('/image/article/description', [ImagesArticle::class, 'updateDescriptionImage']);
    Route::delete('/image/article/{id}', [ImagesArticle::class, 'deleteImageArticle']);
});
