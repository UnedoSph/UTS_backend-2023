<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;

class MediaController extends Controller
{
    public function index()
    {
        # menggunakan model Media untuk select data
        $medias = Media::all();

        if (!empty($medias)) {
            $response = [
                'message' => 'Menampilkan Data Semua Media',
                'data' => $medias,
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'message' => 'Data tidak ada'
            ];
            return response()->json($response, 200);
        }
    }

    public function store(Request $request)
    {
        #validate
        $validateData = $request->validate([
            'id' => 'id berita',
            'title' => 'judul berita',
            'author' => 'penulis berita',
            'description' => 'deskripsi berita',
            'content' => 'konten berita',
            'url' => 'url berita',
            'url_image' => 'url image berita',
            'published_ad' => 'publish berita',
            'category' => 'kategori berita',
            'timestamp' => 'timestamp'
        ]);

        $media = Media::create($validateData);


        $data = [
            'message' => 'Media is created succesfully',
            'data' => $media,
        ];

        // mengembalikan data (json) dan kode 201
        return response()->json($data, 201);
    }

    public function show($id)
    {
        $media = Media::find($id);

        if ($media) {
            $response = [
                'message' => 'Get detail Media',
                'data' => $media
            ];

            return response()->json($response, 200);
        } else {
            $response = [
                'message' => 'Data not found'
            ];

            return response()->json($response, 404);
        }
    }

    public function update(Request $request, $id)
    {
        $media = Media::find($id);

        if ($media) {
            $response = [
                'message' => 'Media is updated',
                'data' => $media->update($request->all())
            ];

            return response()->json($response, 200);
        } else {
            $response = [
                'message' => 'Data not found'
            ];

            return response()->json($response, 404);
        }
    }

    public function destroy($id)
    {
        $media = Media::find($id);

        if ($media) {
            $response = [
                'message' => 'Media is delete',
                'data' => $media->delete()
            ];

            return response()->json($response, 200);
        } else {
            $response = [
                'message' => 'Data not found'
            ];

            return response()->json($response, 404);
        }
    }
}
