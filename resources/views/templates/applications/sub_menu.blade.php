<li class="tabs_controls_item {{ (isset($active) && $active === 'current') || !$active ? 'active': ''}}">
    <a class="tabs_controls_link"
       href="{{route('applications.index', ['applicator_id' => $applicator->id, 'param' => 'current']) }}">Заявки
        текущего месяца</a>
</li>
<li class="tabs_controls_item {{ (isset($active) && $active === 'new') ? 'active': ''}}">
    <a class="tabs_controls_link"
       href="{{route('applications.index', ['applicator_id' => $applicator->id, 'param' => 'new']) }}">Новые</a>
</li>
<li class="tabs_controls_item {{ (isset($active) && $active === 'done') ? 'active': ''}}">
    <a class="tabs_controls_link"
       href="{{route('applications.index', ['applicator_id' => $applicator->id, 'param' => 'done']) }}">Выполненные</a>
</li>
<li class="tabs_controls_item {{ (isset($active) && $active === 'all') ? 'active': ''}}">
    <a class="tabs_controls_link"
       href="{{ route('applications.index', ['applicator_id' => $applicator->id, 'param' => 'all']) }}">Все
        заявки</a>
</li>
<li class="tabs_controls_item {{ (isset($active) && $active === 'draft') ? 'active': ''}}">
    <a class="tabs_controls_link"
       href="{{route('applications.index', ['applicator_id' => $applicator->id, 'param' => 'draft']) }}">Черновик</a>
</li>
<li class="tabs_controls_item {{ (isset($active) && $active === 'canceled') ? 'active': ''}}">
    <a class="tabs_controls_link"
       href="{{route('applications.index', ['applicator_id' => $applicator->id, 'param' => 'canceled']) }}">Отмененные</a>
</li>