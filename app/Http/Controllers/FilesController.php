<?php

namespace App\Http\Controllers;

use App\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function index(Request $request, $paths = '/')
    {
        $userDirPrefix = Helper::storageDirectoryPrefix($request->user());
        $path = trim(str_replace('..', '', $paths), '/');
        $parentPath = dirname($path);
        $storagePath = $userDirPrefix . $path;

        $directories = array_map(function ($directory) use ($userDirPrefix, $path) {
            $dirName = str_replace([$userDirPrefix . $path, '/'], '', $directory);
            $dirLink = preg_replace(
                ['|/{2,}|', '|^/|'],
                ['/', ''],
                $path . '/' . $dirName
            );

            return [
                'name' => $dirName,
                'link' => route('files.index', [$dirLink]),
            ];
        }, Storage::directories($storagePath));

        $files = array_map(function ($file) use ($userDirPrefix, $path) {
            return [
                'name' => str_replace([$userDirPrefix . $path, '/'], '', $file),
                'size' => Helper::fileSizeBytesToHuman(Storage::size($file)),
            ];
        }, Storage::files($storagePath));

        return view('files.index', [
            'path' => '/' . $path,
            'parentPath' => $parentPath,
            'directories' => $directories,
            'files' => $files,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'path' => ['required', 'string', 'max:255'],
            'file' => ['required', 'file'],
        ]);

        $userDirPrefix = Helper::storageDirectoryPrefix($request->user());
        $path = trim(str_replace('..', '', $data['path']), '/');
        $storagePath = $userDirPrefix . $path;

        $uploadedFile = $data['file'];

        $filename = $uploadedFile->getClientOriginalName();
        $filename = str_replace([' '], '_', $filename);

        Storage::putFileAs($storagePath, $uploadedFile, $filename);

        return redirect()->back();
    }
}
