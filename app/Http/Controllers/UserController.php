<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Applicator;
use App\Models\Cooperation;
use App\Models\Counter;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('templates.users.list', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $counters = Counter::all();
        return view('templates.users.form', ['counters' => $counters]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if($request->validated()) {

            $user = User::create($request->validated());

            if ($user) {
                $counter = Counter::find($request->counter_id);
                if ($counter->id) {
                    $cooperation = $counter->getCooperation();
                    if ($cooperation->id){
                        $applicator = Applicator::create([
                            'user_id' => $user->id,
                            'counter_id'=> $request->counter_id,
                            'cooperation_id' => $cooperation->id,
                        ]);
                        session()->flash('success', 'Новый пользователь успешно создан.');
                        return redirect()->route('applicators.show', ['applicator' => $applicator]);
                    } else session()->flash('alert', 'Не заполнены условия сотрудничества с контрагентом.');
                } else {
                    session()->flash('alert', 'Контрагент не существует.');
                }
            } else {
                session()->flash('alert', 'Ошибка создания нового пользователя!');
            }
        } else session()->flash('alert', 'Ошибка валидации.');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $counters = Counter::all();
        return view('templates.users.form', compact('user', 'counters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
           if ($request->validated()) {

                if ($user->update($request->validated())){

                    //обновить подчиненную таблицу
                    $user->applicator()->update(['counter_id' => $request->counter_id]);

                    session()->flash('success', 'Данные пользователя успешно изменены.');
                } else {
                    session()->flash('alert', 'Данные не изменены!');
                }
            }
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user = User::findOrFail($user->id);
        if (isset($user)) {
            $user->applicator()->delete();
            User::destroy($user->id);
            session()->flash('success', 'Пользователь успешно удален.');
            return redirect(route('users.index'));
        }
    }
}
