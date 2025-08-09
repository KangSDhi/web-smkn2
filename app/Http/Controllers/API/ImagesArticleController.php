<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ImageArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImagesArticleController extends Controller
{
    public function getImagesArticleByIdArticle($idArticle)
    {
        $imagesArticle = ImageArticle::where('article_id', $idArticle)->get();
        return response()->json([
            'http_code' => 200,
            'message' => 'Berhasil Mengambil Gambar Artikel!',
            'data' => $imagesArticle
        ], 200);
    }

    public function storeBatchImages(Request $request)
    {
        $articleId = $request->input('article_id');
        $images = $request->file('image');
        $imageDesc = $request->input('image_desc');
        foreach ($images as $key => $image) {
            $fileName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('images_article', $image, $fileName);

            $imagesArticle = new ImageArticle();
            $imagesArticle->image = $fileName;
            $imagesArticle->description = $imageDesc[$key];
            $imagesArticle->article_id = $articleId;
            $imagesArticle->save();
        }

        return response()->json([
            'http_code' => 201,
            'message' => 'Berhasil Menambahkan Gambar Artikel!',
        ], 201);
    }
}
