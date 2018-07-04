@push('hidden')
    <div class="hidden">
        <div id="editTransport" class="popup">
            <div class="flex popup__flex">
                <h3 class="popup__title pass-popup__title">Редактировать транспорт</h3>
                <div class="popup-close close-btn js-close-modal"></div>
            </div>
            <form action="{{ route('update.transport', ['id' => $transport->id]) }}" class="form" method="POST">
                {{ csrf_field() }}
                <fieldset class="form__fieldset-small">
                    <div class="form__textarea-wrapper">
                        <textarea class="form__textarea popup__textarea" placeholder="Введите информацию по ТС"
                                  name="transport_info">{{ $transport->info }}</textarea>
                    </div>
                </fieldset>
                <div class="popup__toolbar">
                    {{ method_field('PUT') }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn btn_recover btn_full" type="submit">Изменить</button>
                </div>
            </form>
        </div>
    </div>
@endpush