@php  @endphp
<li class="b-topnav__item">
    <a href="{{ route('applications.index', ['applicator_id' => $user->applicator->id, 'param' => 'current' ]) }}" class="b-topnav__link
    {{ in_array(Route::currentRouteName(), ['applications.index', 'applications.create']) ? ' active': '' }}">Мои заявки</a>
</li>
<li class="b-topnav__item">
    <a href="{{ route('productranges.list', ['applicator' => $user->applicator->id, 'consigneer_id' => $user->applicator->getConsigneers()->first() ]) }}" class="b-topnav__link
    {{ in_array(Route::currentRouteName(), ['productranges.list']) ? ' active': '' }}">Номенклатура</a>
</li>
<li class="b-topnav__item">
    <a href="" class="b-topnav__link ">Документация</a>
</li>
<li class="b-topnav__item">
    <a href="{{ route('contactquery.index', ['applicator_id' => $user->applicator->id]) }}" class="b-topnav__link
    {{ in_array(Route::currentRouteName(), ['contactquery.index']) ? ' active': '' }}">Мои обращения</a>
</li>
<li class="b-topnav__item">
    <a href="" class="b-topnav__link b-topnav__link-toggle js-nav-toggle">{{ $user->firstName ." ". $user->lastName }}</a>
    <ul class="b-submenu__list js-nav">
        <li class="b-submenu__item ">
            <a  href="{{  route('applicators.show', ['applicator_id' => $user->applicator->id]) }}" class="b-topnav__link
                {{ in_array(Route::currentRouteName(), ['applicators.show']) ? ' active': '' }}">Мой профиль</a>
        </li>
        <li class="b-submenu__item ">
            <a class="b-submenu__link " href="{{ route('logout') }}"
               onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
                Выйти
            </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            {{ csrf_field() }}
        </form>
    </ul>
</li>