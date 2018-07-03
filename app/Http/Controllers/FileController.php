<?php

namespace App\Http\Controllers;

use App\Models\Lunit;
use Illuminate\Http\Request;
use App\Models\Traits\FileTrait;
use App\Models\File;
use Validator;

class FileController extends Controller
{
   private $ext = ['doc', 'docx', 'pdf', 'odt', 'xls', 'xlsx'];

    public function __construct()
    {
        //$this->middleware('auth');
    }
    /*
    public function index($lunit)
    {
        $files = Lunit::findOrFail($lunit)->files;
        return response()->json(['files' => $files]);

    }
    */
    public function store(Request $request, $lunit)
    {
        $max_size = 51200;
        $all_ext = implode(',', $this->ext);

        $this->validate($request, [
            'file' => 'required|file|mimes:' . $all_ext . '|max:' . $max_size
        ], [
            'max' => 'Файл не более 50 Мб',
            'mimes' => 'допустимые типы файлов: doc, docx, pdf, odt, xls, xlsx',
        ]);

        //как отдать на клиент сообщения, лучше даже кастомные?

        $id = FileTrait::fileUpload($request);
        $newFile = File::findOrFail($id);
        $newFile->lunit_id = $lunit;
        $newFile->save();

        return response()->json(['file' => $newFile]);
    }

}
