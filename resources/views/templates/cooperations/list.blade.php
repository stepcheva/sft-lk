<article class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{$title}}</h3>
    </div>
    <div class="panel-body">
            <p>Товарный лимит {{ $cooperation->min_volume }} Р</p>
            <p>{{ $cooperation->description }}</p>
    </div>
</article>