<div class="pf-info">
    <div class="a-title">
        <div class="a-title__h3">{{ $title }}</div>
    </div>
    <div class="pf-tile">
        <div class="pf-tile__col pf-tile__col_first">
            <div class="info-title info-title_mb25">Личные данные</div>
            <div class="pf-table">
                <div class="pf-table__row">
                    <div class="pf-table__td">
                        <span class="pf-table__title">Фамилия:</span>
                    </div>
                    <div class="pf-table__td">
                        {{ $user->lastName  }}
                    </div>
                </div>
                <div class="pf-table__row">
                    <div class="pf-table__td">
                        <span class="pf-table__title">Имя:</span>
                    </div>
                    <div class="pf-table__td">
                        {{ $user->firstName  }}
                    </div>
                </div>
                <div class="pf-table__row">
                    <div class="pf-table__td">
                        <span class="pf-table__title">Отчество:</span>
                    </div>
                    <div class="pf-table__td">
                        {{ $user->middleName  }}
                    </div>
                </div>
            </div>
        </div>
        <div class="pf-tile__col pf-tile__col_second">
            <div class="info-title info-title_mb25">Пользовательские данные</div>
            <div class="pf-table">
                <div class="pf-table__row">
                    <div class="pf-table__td">
                        <span class="pf-table__title">Телефон:</span>
                    </div>
                    <div class="pf-table__td">
                        {{ $user->phone  }}
                    </div>
                </div>
                <div class="pf-table__row">
                    <div class="pf-table__td">
                        <span class="pf-table__title">E-mail:</span>
                    </div>
                    <div class="pf-table__td">
                        {{ $user->email  }}
                    </div>
                </div>
                <div class="pf-table__row">
                    <div class="pf-table__td">
                        <span class="pf-table__title">Контрагент:</span>
                    </div>
                    <div class="pf-table__td">
                        {{ $user->applicator->counter->name }}
                    </div>
                </div>
            </div>
        </div>
        <div class="pf-tile__col pf-tile__col_third">
            <div class="info-title info-title_mb25">Пароль</div>
            <div class="pf-table__td">
                <span class="pf-table__title">{{ $user->password }}</span>
            </div>
            <p class="pf-text">
                @if($user->passwordIsValid())
                    Необходимо сменить пароль в течение
                    {{ $user->passwordDayIsValid() }} дней.
                @else
                    Срок действия пароля истек.
                @endif
            </p>
            <div class="pf-pass">
                <a class="pf-link" href="{{ route('users.edit', ['user' => $user]) }}">Сменить пароль</a>
            </div>
        </div>
    </div>
</div>