<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Index\IndexController as Index;

Route::get('/{any?}', [Index::class, 'index'])->where('any', '^(?!api\/)[\/\w\.-]*');;
