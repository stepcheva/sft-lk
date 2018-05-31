@extends('layouts._app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    @include('flashes')

                    <div class="panel-heading">
                        <h4>Шаг 3. Выбор объема </h4>
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
                                      action="{{ route('applications.confirm', ['application' => $application]) }}">

                                    {{ csrf_field() }}

                                    <table id="productranges" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Марка</th>
                                            <th class="text-center">Граммаж</th>
                                            <th class="text-center">Формат</th>
                                            <th class="text-center">Объем 1 декада</th>
                                            <th class="text-center">Объем 2 декада</th>
                                            <th class="text-center">Объем 3 декада</th>
                                            <th class="text-center">Доставка/Цена</th>
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
                                                    <td><input class="form-control-sm" type="text"
                                                               name="{{'productranges['. $key. '][volume_1]'}}"
                                                               id="volume_1" placeholder="" value="">
                                                        @if ($errors->has('products['. $key. '][volume_1]'))
                                                            <span class="help-block">
                                            <strong>{{ $errors->first('products['. $key. '][volume_1]') }}</strong>
                                        </span>
                                                        @endif
                                                    </td>
                                                    <td><input class="form-control-sm" type="text"
                                                               name="{{'productranges['. $key. '][volume_2]'}}"
                                                               id="volume_2" placeholder="" value="">
                                                        @if ($errors->has('products['. $key. '][volume_2]'))
                                                            <span class="help-block">
                                            <strong>{{ $errors->first('products['. $key. '][volume_2]') }}</strong>
                                        </span>
                                                        @endif</td>
                                                    <td><input class="form-control-sm" type="text"
                                                               name="{{'productranges['. $key. '][volume_3]'}}"
                                                               id="volume_3" placeholder="" value="">
                                                        @if ($errors->has('products['. $key. '][volume_3]'))
                                                            <span class="help-block">
                                            <strong>{{ $errors->first('products['. $key. '][volume_3]') }}</strong>
                                        </span>
                                                        @endif</td>
                                                    <td>
                                                        @if($product->getConsigneerDeliveries($application))
                                                            <select name="{{ 'productranges['. $key. '][consigneer_delivery_id]'}}"
                                                                    class="form-control">
                                                                @foreach($product->getConsigneerDeliveries($application) as $consigneer_delivery)
                                                                    <option value="{{ $consigneer_delivery->id }}">{{ $consigneer_delivery->delivery->name . ' / ' . $consigneer_delivery->price }}</option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                    </td>
                                                    <input type="hidden"
                                                           name="{{'productranges['. $key. '][productrange_id]'}}"
                                                           value="{{ $product->id }}">

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
                                        <div class="pull-right">
                                            <a class="btn btn-info btn"
                                               href="{{ route('applications.create', ['applicator_id' => $application->applicator->id]) }}">
                                                Отменить</a>
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <button type="submit" class="btn btn-success">Далее</button>
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