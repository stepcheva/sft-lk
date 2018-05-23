<div class="panel-body"><h3>{{$title}}</h3>
    @foreach($consigneers as $consigneer)
        <div class="panel panel-body" style="white-space:inherit;">
            <h3>{{ $consigneer->name }}</h3>
            <p>{{ $consigneer->address }}</p>
        </div>
    @endforeach
</div>