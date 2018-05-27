@extends('layouts._app')

@section('content')
    <div class="container">

        @include ('flashes')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div>

                    </div>
                    <div class="panel-heading"><h3>Номенклатура</h3></div>
                    <table id="productranges" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">Марка</th>
                            <th class="text-center">Граммаж</th>
                            <th class="text-center">Формат</th>
                            <th class="text-center">Минимальный объем</th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        </thead>
                        <tbody>


                        @if (isset($productranges))

                            @foreach($productranges as $key => $product)
                                <tr>
                                    <td> {{ $product->brand }} </td>
                                    <td> {{ $product->grammage }} </td>
                                    <td> {{ $product->format }} </td>
                                    <td> {{ $product->min_lot }} </td>

                                </tr>
                            @endforeach
                            <tr>

                            </tr>
                        @else
                            <h2> Нет товаров у текущего поставщика</h2>
                        @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection