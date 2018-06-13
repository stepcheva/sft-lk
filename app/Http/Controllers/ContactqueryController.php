<?php

namespace App\Http\Controllers;

use App\Models\Contactquery;
use App\Models\Traits\FileTrait;
use App\Models\Applicator;
use App\Models\File;
use Illuminate\Http\Request;
use Validator;
use Mail;

class ContactqueryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @rApplicator $applicatoreturn \Illuminate\Http\Response
     */
    public function index(Applicator $applicator)
    {
        $contactqueries = Contactquery::where('applicator_id', $applicator->id)->latest()->paginate(15);
        return view('templates.contactquery.index', compact('applicator', 'contactqueries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Applicator $applicator)
    {
        return view('templates.users.contact', ['applicator' => $applicator]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Applicator $applicator, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'file|max:51200',
        ], [
            'max' => 'Файл не более 50 Мб',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $contactquery = Contactquery::create([
            'theme' => $request->theme,
            'querytext' => $request->querytext,
            'applicator_id' => $applicator->id,
            'file_id' => FileTrait::fileUpload($request),
        ]);

        $email = $contactquery->applicator->user->email;
        $subject = 'Уведомление о создании сообщения';
        $data = [
            'querytext' => $contactquery->querytext,
            'theme' => $contactquery->theme,
            'filePath' => $contactquery->file->path,
            'fileName' => $contactquery->file->name,
        ];
        $view = "templates.mail.contactquery";

        Mail::send(['html' => $view], $data, function($message) use ($subject, $email) {
            $message->to('file.storages.ex@gmail.com');
            $message->cc($email);
            $message->from('file.storages.ex@gmail.com', 'SFT Group');
            $message->subject($subject);
        });

        session()->flash('success', 'Новое обращение успешно создано.');
        return redirect()->route('applicators.show', ['applicator' => $applicator]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contactquery  $contactquery
     * @return \Illuminate\Http\Response
     */
    public function show(Contactquery $contactquery)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contactquery  $contactquery
     * @return \Illuminate\Http\Response
     */
    public function edit(Applicator $applicator, Contactquery $contactquery)
    {
        $file = $contactquery->getFilePath();
        return view('templates.users.contact', compact('applicator', 'contactquery', 'file'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contactquery  $contactquery
     * @return \Illuminate\Http\Response
     */
    public function update(Applicator $applicator, Contactquery $contactquery, Request $request)
    {
        $contact = $contactquery->update([
            'theme' => $request->theme,
            'querytext' => $request->querytext,
            'applicator_id' => $applicator->id,
        ]);

        session()->flash('success', 'Обращение успешно изменено.');
        return redirect()->route('contactquery.index', ['applicator'=> $applicator]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contactquery  $contactquery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Applicator $applicator, Contactquery $contactquery)
    {
        if (isset($contactquery->file)) {
            $contactquery->file()->delete();
        }
        Contactquery::destroy($contactquery->id);
        session()->flash('success', 'Обращение успешно удалено.');
        return redirect()->route('contactquery.index', ['applicator'=>$applicator]);
    }

    public function send(Contactquery $contactquery)
    {

    }
}
