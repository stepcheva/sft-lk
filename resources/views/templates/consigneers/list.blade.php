<article class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{$title}}</h3>
    </div>
    <div class="panel-body">
        @foreach($consigneers as $consigneer)
            <div class="panel panel-body" style="white-space:inherit;">
                <h3>{{ $consigneer->name }}</h3>
                <p>{{ $consigneer->address }}</p>
            </div>
        @endforeach
    </div>
</article>
