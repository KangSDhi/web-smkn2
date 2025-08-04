<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function getArticles()
    {
        $articles = Article::all();

        return response()->json([
            'http_code' => 200,
            'message' => 'Berhasil Mengambil Artikel',
            'data' => $articles,
        ], 200);
    }

    public function getArticlesLimit(int $limit) {
        $articles = Article::all()->take($limit);

        return response()->json([
            'http_code' => 200,
            'message' => 'Berhasil Mengambil Artikel',
            'data' => $articles,
        ], 200);
    }

    public function getArticleById(int $id)
    {

    }

    public function getArticleBySlug(string $slug)
    {

    }

    public function getArticlesByUserId(int $id)
    {
        $articles = Article::where('user_id', '=', $id)
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'http_code' => 200,
            'message' => 'Berhasil Mengambil Artikel',
            'data' => $articles,
        ], 200);
    }

    public function storeArticle(Request $request)
    {
        $fileName = null;
        if ($request->hasFile('image')) {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'body' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'user_id' => 'required',
            ]);

            if($validator->fails()){
                return response()->json([
                    'http_code' => 400,
                    'errors' => $validator->errors()
                ], 400);
            }

            $image = $request->file('image');
            $fileName = Str::uuid() . '.' . $image->getClientOriginalExtension();

            Storage::disk('public')->putFileAs('cover_articles', $image, $fileName);

        } else {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'body' => 'required',
                'user_id' => 'required',
            ]);

            if($validator->fails()){
                return response()->json([
                    'http_code' => 400,
                    'errors' => $validator->errors()
                ], 400);
            }
        }

        $article = new Article();
        $article->title = $request->title;
        $article->slug = Str::slug($request->title, '-');
        $article->body = $request->body;
        $article->image = $fileName;
        $article->user_id = $request->user_id;
        $article->save();

        return response()->json([
            'http_code' => 201,
            'message' => 'Berhasil Menambah Artikel',
            'data' => $article,
        ], 201);

    }

    public function updateArticle(Request $request, int $id)
    {
//        dd($request->all());
        $fileName = null;
        if ($request->hasFile('image')) {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'body' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'user_id' => 'required',
            ]);

            if($validator->fails()){
                return response()->json([
                    'http_code' => 400,
                    'errors' => $validator->errors()
                ], 400);
            }

            $image = $request->file('image');
            $fileName = Str::uuid() . '.' . $image->getClientOriginalExtension();

            Storage::disk('public')->putFileAs('cover_articles', $image, $fileName);

        } else {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'body' => 'required',
                'user_id' => 'required',
            ]);

            if($validator->fails()){
                return response()->json([
                    'http_code' => 400,
                    'errors' => $validator->errors()
                ], 400);
            }
        }

        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->slug = Str::slug($request->title, '-');
        $article->body = $request->body;
        $article->image = $fileName;
        $article->user_id = $request->user_id;
        $article->save();

        return response()->json([
            'http_code' => 201,
            'message' => 'Berhasil Mengubah Artikel',
            'data' => $article,
        ], 201);
    }

    public function deleteArticle(int $id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return response()->json([
            'http_code' => 200,
            'message' => 'Berhasil Menghapus Artikel',
            'data' => $article,
        ], 200);
    }

}
