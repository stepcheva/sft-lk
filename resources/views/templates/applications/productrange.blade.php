@extends('layouts._app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    @include('flashes')

                    <div class="panel-heading">
                        <h4>Выбор продукции</h4>
                    </div>
                    <div class="panel-body">
                        <div class="panel-body">

                        </div>
                        <div class="box">
                            <div class="box-header">
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <form method="POST" action="{{ route('applications.product', ['applicator' => $applicator]) }}">

                                {{ csrf_field() }}

                                <table id="users" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Марка</th>
                                        <th>Граммаж</th>
                                        <th>Формат</th>
                                        <th>Минимальный объем</th>
                                        <th>Объем 1 декада</th>
                                        <th>Объем 2 декада</th>
                                        <th>Объем 3 декада</th>
                                        <th>Способ доставки</th>
                                        <th>Цена</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                    </thead>
                                    <tbody>
                                    @if (isset($productranges))
                                        <pre>{{ dd($productranges) }}</pre>
                                        @foreach($productranges as $product)
                                            <tr>
                                                <td>
                                                    <input class = "checkbox checkbox-success" type="checkbox" name="productrange_id" id="productrange_id" value="{{ $product[0]->id}}">
                                                </td>
                                                <td> {{ $product[0]->brand }} </td>
                                                <td> {{ $product[0]->grammage }} </td>
                                                <td> {{ $product[0]->format }} </td>
                                                <td> {{ $product[0]->min_lot }} </td>
                                                <td> <input class="form-control-sm" type="text" name="volume_1" id="volume_1" placeholder="" value="">
                                                </td>
                                                <td><input class="form-control-sm" type="text" name="volume_2" id="volume_2" placeholder="" value=""> </td>
                                                <td><input class= "form-control-sm" type="text" name="volume_3" id="volume_3" placeholder="" value=""> </td>
                                                <td> {{ $product[1]->delivery->name }}</td>
                                                <td> {{ $product[1]->price }}</td>
                                            </tr>
                                        @endforeach
                                            <tr>

                                            </tr>
                                    @else
                                        <h2> Нет товаров у текущего поставщика</h2>
                                    @endif
                                    </tbody>
                                </table>

                                <div>
                                    <!--Пагинация-->
                                </div>
                                <div>

                                        <a class="btn btn-info btn-sm"
                                           href="{{ route('applications.create',  ['applicator' => $applicator])}}">Назад</a>

                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <button type="submit" class="btn btn-success btn-sm">Далее</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection