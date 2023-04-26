<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Image;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        $image = $request->file('image');
        Log::debug($image); // 確認用
        $filename = uniqid() . '.' . $image->getClientOriginalExtension();
        $store = $image->storeAs('images', $filename, 'public');
        $path = '/storage/' . $store;
        $data = [
            'path' => $path,
            'file_name' => $filename,
        ];
        $response = Image::create($data);
        return response()->json($response);
    }

    public function showFile(Request $request)
    {
    }

    // public function test()
    // {
    //     return response()->json('hoge');
    // }
}
