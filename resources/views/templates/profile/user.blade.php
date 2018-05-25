<article class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{$title}}</h3>
    </div>
    <div class="panel panel-body" style="white-space:inherit;">
        <h3>{{ $user->lastName . " ". $user->firstName . " " . $user->middleName }}</h3>
        <p>{{ $user->applicator->counter->name }}</p>
    </div>
</article>