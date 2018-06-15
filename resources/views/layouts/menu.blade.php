<li class="b-topnav__item">
    <a href="{{ route('applications.index', ['applicator_id' => $user->applicator->id]) }}" class="
    {{ in_array(Route::currentRouteName(), ['applications.index', 'applications.create']) ? 'b-topnav__link active': 'b-topnav__link' }}">Мои заявки</a>
</li>
<li class="b-topnav__item">
    <a href="{{ route('productranges.list', ['applicator_id' => $user->applicator->id]) }}" class="
    {{ in_array(Route::currentRouteName(), ['productranges.list']) ? 'b-topnav__link active': 'b-topnav__link' }}">Номенклатура</a>
</li>
<li class="b-topnav__item">
    <a href="" class="b-topnav__link ">Документация</a>
</li>
<li class="b-topnav__item">
    <a href="{{ route('contactquery.index', ['applicator_id' => $user->applicator->id]) }}" class="
    {{ in_array(Route::currentRouteName(), ['contactquery.index']) ? 'b-topnav__link active': 'b-topnav__link' }}">Мои обращения</a>
</li>
<li class="b-topnav__item">
    <a href="" class="b-topnav__link b-topnav__link-toggle js-nav-toggle">{{ $user->firstName ." ". $user->lastName }}</a>
    <ul class="b-submenu__list js-nav">
        <li class="b-submenu__item ">
            <a  href="{{  route('applicators.show', ['applicator_id' => $user->applicator->id]) }}" class="
                {{ in_array(Route::currentRouteName(), ['applicators.show']) ? 'b-topnav__link active': 'b-topnav__link' }}">Мой профиль</a>
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