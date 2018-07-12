@extends('layouts.master')
<?php $user = $applicator->user ?>
@section('title', "Мои обращения")

@section('content')

    @include('flashes')

    <h1 class="ai-title">Мои обращения</h1>
    <div class="panel-body">
        <div class="panel-body">
            <?php $user = $applicator->user ?>
            <div class="default-tabs">
                <a class=""
                   href="{{ route('contactquery.create', ['applicator_id' => $applicator->id]) }}">Добавить
                    обращение</a>
            </div>
            <hr/>

            <div class="article">

                @foreach($contactqueries as $contactquery)
                    <div class="apps__item js-app-item">
                        <div class="apps__inner">
                            <span class="apps__number">Обращение</span>
                            <span class="apps__date">от {{ $contactquery->created_at->format('d.m.Y') }}</span>
                            <div class="apps__block apps__block_top">
                                <div class="apps__block-col">
                                    <div class="apps__data-title">
                                        Тема
                                    </div>
                                    <div class="apps__data-text">
                                        {{ $contactquery->theme }}
                                    </div>
                                </div>
                                <div class="apps__block-col">
                                    <div class="apps__data-title">
                                        Текст
                                    </div>
                                    <div class="apps__data-text">
                                        {{  $contactquery->querytext }}
                                    </div>
                                </div>
                                @isset( $contactquery->file)
                                    <div class="apps__block-col">
                                        <div class="apps__data-title">
                                            Файл
                                        </div>
                                        <div class="apps__data-text">
                                            <a href="{{  $contactquery->file->path }}">{{$contactquery->file->name}}</a>
                                        </div>
                                    </div>
                                @endisset
                            </div>

                            <div class="apps__more">
                                <form method="POST"
                                      action="{{ route('contactquery.destroy',  ['contactquery' => $contactquery, 'applicator' => $applicator]) }}">
                                    <a class=""
                                       href="{{ route('contactquery.edit',  ['contactquery' => $contactquery, 'applicator' => $applicator]) }}">edit</a>
                                    <input type="hidden" name="_method" value="delete"/>
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <button type="submit" class="">delete</button>
                                </form>
                            </div>
                            <hr/>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection