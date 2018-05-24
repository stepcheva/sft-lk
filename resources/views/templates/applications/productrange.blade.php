@extends('layouts._app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    @include('flashes')

                    <div class="panel-heading">
                        <h4>Шаг 2. Выбор продукции</h4>
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
                                      action="{{ route('applications.product', ['application' => $application]) }}">

                                    {{ csrf_field() }}

                                    <table id="productranges" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Марка</th>
                                            <th class="text-center">Граммаж</th>
                                            <th class="text-center">Формат</th>
                                            <th class="text-center">Минимальный объем</th>
                                            <th class="text-center"></th>
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
                                                    <td class="text-center">
                                                        <input class="checkbox checkbox-success center" type="checkbox"
                                                               name="{{'productranges[' .$product->id.']'}}" value="1">
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
                                           href="{{ route('applications.create',  ['applicator' => $application->applicator])}}">Назад</a>

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