<?php

namespace App\Models\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\File;


trait FileTrait
{
    public static function fileUpload(Request $request)
    {
        if ($request->hasFile('file')) {

            $file = $request->file;

            $name = $file->getClientOriginalName();

            //добавить, в случае необходимости ограничения по размеру файла и по типам файлов
            //$size = $request->file->getSize();

            

            $file->storeAs("", "$name", "public");
	

            $file = File::create([
                'name' => $name,
                'path' => asset("storage/$name"),
            ]);
        };

        return isset($file) ? $file->id : Null;
    }
}