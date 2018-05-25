@section('content')
    <div class="container">
        @include ('flashes')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading"><h3>Мои заявки</h3></div>
                    <td>@isset($applicator)
                            @include ('templates.applications.list', ['applicator' => $applicator, 'title' => 'Мои заявки'])
                        @endisset
                    </td>
                </div>
            </div>
        </div>
    </div>
@endsection