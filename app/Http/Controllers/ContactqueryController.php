<?php

namespace App\Http\Controllers;

use App\Models\Contactquery;
use App\Models\Applicator;
use Illuminate\Http\Request;
use Mail;

class ContactqueryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Applicator $applicator)
    {
        $contactqueries = Contactquery::where('applicator_id', $applicator->id)->latest()->paginate(15);
        return view('templates.users.contactqueries_list', compact('applicator', 'contactqueries'));
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
        $contactquery = Contactquery::create([
            'theme' =>  $request->theme,
            'querytext' => $request->querytext,
            'applicator_id' => $applicator->id]);

        //$applicator = Applicator::find($contactquery->applicator_id);
        $subject = 'Уведомление о создании обращения';
        $email = $applicator->user->email;
        $data = ['querytext' => $contactquery->querytext, 'theme' => $contactquery->theme];
        $view = "templates.mail.contactquery";
        Mail::send(['html' => $view], $data, function($message) use ($subject, $email) {
            $message->to($email);
            $message->cc('file.storages.ex@gmail.com');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contactquery  $contactquery
     * @return \Illuminate\Http\Response
     */
    public function edit(Contactquery $contactquery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contactquery  $contactquery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contactquery $contactquery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contactquery  $contactquery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contactquery $contactquery)
    {
        //
    }

    public function send(Contactquery $contactquery) {

    }
}
