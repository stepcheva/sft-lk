<?php

namespace App\Models\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\File;


trait FileTrait
{
    public static function fileUpload(Request $request)
    {
        if ($request->hasFile('file') && $request->file->isValid()) {

            $file = $request->file;

            $name = $file->getClientOriginalName();

            //добавить, в случае необходимости ограничения по размеру файла и по типам файлов
            //$size = $request->file->getSize();

            $path = "uploaded";

            $file->store($path);

            $file = File::create([
                'name' => $name,
                'path' => asset("$path/$name"),
            ]);

            return $file ? $file->id : Null;
        };
    }
}