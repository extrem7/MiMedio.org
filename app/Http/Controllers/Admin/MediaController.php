<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Str;

class MediaController extends Controller
{
    public function upload(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|max:2048|mimes:jpg,jpeg,bmp,png',
        ]);

        $image = $request->file('image');
        $name = Str::random(25);
        $file = $image->storeAs('public/uploads', $name . '.' . $image->getClientOriginalExtension());

        return ['location' => \Storage::url($file)];
    }

    public function destroy(Media $media)
    {
        $media->delete();
        return response()->json(['status' => 'ok']);
    }
}
