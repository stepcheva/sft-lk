@extends('layouts._app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    @include('flashes')

                    <div class="panel-heading">
                        <h4>Шаг 4. Подтверждение заявки</h4>
                    </div>

                    <div class="panel-body">
                        <div class="panel-body">
                            <form method="POST"
                                  action="{{ route('applications.send', compact('application', 'product_applications','volume', 'price', 'comment')) }}">
                                {{ csrf_field() }}

                                @include('templates.applications.print', compact('application', 'product_applications','volume', 'price'))

                                <div class="form-group">
                                    <div>
                                        <label for="comment" class="control-label">Комментарий к
                                            заказу:</label>
                                        <textarea id="comment" class="form-control" name="comment"
                                                  value="">
                                                </textarea>

                                        @if ($errors->has('comment'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('comment') }}</strong>
                                                 </span>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <div class="pull-right">

                                        <a class="btn btn-info btn"
                                           href="{{ route('applications.create', ['applicator_id' => $application->applicator->id]) }}">
                                            Отменить</a>
                                        {{ method_field('POST') }}
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <button type="submit" class="btn btn-success">Подтвердить</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection