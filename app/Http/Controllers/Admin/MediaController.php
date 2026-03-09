<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $files = collect(Storage::disk('public')->allFiles())
            ->reject(fn ($path) => str_contains($path, '.gitignore'))
            ->map(function ($path) {
                return [
                    'path' => $path,
                    'url' => Storage::disk('public')->url($path),
                    'size' => Storage::disk('public')->size($path),
                ];
            });

        return view('admin.media.index', compact('files'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => ['required', 'image', 'max:4096']
        ]);

        $request->file('file')->store('media', 'public');

        return back()->with('success', 'Tải ảnh thành công.');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'path' => ['required', 'string']
        ]);

        Storage::disk('public')->delete($request->path);

        return back()->with('success', 'Đã xóa tập tin.');
    }
}
