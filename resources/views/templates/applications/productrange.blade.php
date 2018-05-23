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
                                <form method="POST"
                                      action="{{ route('applications.product', ['applicator' => $applicator]) }}">

                                    {{ csrf_field() }}

                                    <table id="productranges" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Марка</th>
                                            <th class="text-center">Граммаж</th>
                                            <th class="text-center">Формат</th>
                                            <th class="text-center">Минимальный объем</th>
                                            <th class="text-center">Объем 1 декада</th>
                                            <th class="text-center">Объем 2 декада</th>
                                            <th class="text-center">Объем 3 декада</th>
                                            <th class="text-center">Цена и способ доставки</th>
                                            <th class="text-center"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                        </thead>
                                        <tbody>
                                        @if (isset($productranges))
                                            @foreach($productranges as $product)
                                                <tr>
                                                    <td> {{ $product->brand }} </td>
                                                    <td> {{ $product->grammage }} </td>
                                                    <td> {{ $product->format }} </td>
                                                    <td class="text-center"> {{ $product->min_lot }} </td>
                                                    <td><input class="form-control-sm" type="text" name="volume_1"
                                                               id="volume_1" placeholder="" value="">
                                                    </td>
                                                    <td><input class="form-control-sm" type="text" name="volume_2"
                                                               id="volume_2" placeholder="" value=""></td>
                                                    <td><input class="form-control-sm" type="text" name="volume_3"
                                                               id="volume_3" placeholder="" value=""></td>
                                                    <td>
                                                        @if($consigneer_deliveries)
                                                            <select name="consigneer_delivery_id" class="form-control">
                                                                @foreach($consigneer_deliveries as $consigneer_delivery)
                                                                    <option value="{{ $consigneer_delivery->id }}">{{ $consigneer_delivery->delivery->name . ' ' . $consigneer_delivery->price }}</option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                        @if ($errors->has('consigneer_delivery_id'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('consigneer_delivery_id') }}</strong>
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <input class="checkbox checkbox-success center" type="checkbox"
                                                               name="productrange_id" id="productrange_id"
                                                               value="{{ $product->id}}">
                                                    </td>
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
                                        {{ $productranges->links() }}
                                        Показано: {{ $productranges->lastItem() }} из {{  $productranges->total() }}
                                    <div class="pull-right">

                                        <a class="btn btn-info btn-sm"
                                           href="{{ route('applications.create',  ['applicator' => $applicator])}}">Назад</a>

                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <button type="submit" class="btn btn-success btn-sm">Далее</button>
                                    </div>
                                    </div>
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