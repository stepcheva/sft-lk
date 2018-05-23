<div class="panel-body"><h3>{{$title}}</h3>
    <div class="panel panel-body" style="white-space:inherit;">
        <h3>{{ $user->lastName . " ". $user->firstName . " " . $user->middleName }}</h3>
        <p>{{ $user->applicator->counter->name }}</p>
    </div>
</div>