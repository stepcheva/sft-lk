@extends('layouts._app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    @include('flashes')

                    <div class="panel-heading">
                        <h4>Список пользователей</h4>
                    </div>
                    <div class="panel-body">
                        <div class="panel-body">
                            <a class="btn btn-sm btn-success pull-right"
                               href="{{ route('users.create')}}">Новый пользователь </a>
                        </div>
                        <div class="box">
                            <div class="box-header">
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                <table id="users" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Фамилия</th>
                                        <th>Имя</th>
                                        <th>Отчество</th>
                                        <th>email</th>
                                        <th>Пароль</th>
                                        <th>Срок действия пароля</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                    </thead>
                                    <tbody>
                                    @if (isset($users))
                                        @foreach($users as $user)
                                            <tr>
                                                <td> {{ $user->lastName }} </td>
                                                <td> {{ $user->firstName }} </td>
                                                <td> {{ $user->middleName }} </td>
                                                <td> {{ $user->email }} </td>
                                                <td> {{ $user->password }} </td>
                                                <td> {{ $user->passwordUntil }} </td>
                                                <td style="text-align: center">
                                                    <form method="POST" action="{{ route ('users.destroy', ['user' => $user]) }}">
                                                        <a class="btn btn-primary btn-sm"
                                                           href="{{ route('applicators.show', ['applicator' => $user->applicator]) }}">show</a>

                                                        <a class="btn btn-info btn-sm"
                                                           href="{{ route('users.edit', ['user' => $user]) }}">edit</a>

                                                        <input type="hidden" name="_method" value="delete"/>
                                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                        <button type="submit" class="btn btn-danger btn-sm">delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <h2> Нет пользователей в базе данных</h2>
                                    @endif
                                    </tbody>
                                </table>
                                <div> {{ $users->links() }}</div>
                                <div>
                                    Показано: {{ $users->lastItem() }} из {{  $users->total() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
