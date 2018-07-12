@extends('layouts._app')

@section('content')

    <form method="POST" action="{{ route('applications.update', ['id' => $id]) }}">
    <div class="form-group">
        <div>
            <label for="query" class="control-label">Текст обращения</label>
            <textarea id="query" class="form-control" name="query"
                      rows="18" value="" required> {{ $response }}
            </textarea>

        </div>
    </div>
    <input type="hidden" name="_method" value="put"/>
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <button type="submit" class="btn btn-danger btn-sm">delete</button>
</form>

@endsection