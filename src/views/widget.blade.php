<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Settings <b class="caret"></b></a>
    <ul class="dropdown-menu">
        @foreach(\Config::get('dbConfigAdmin::pages', []) as $url => $page)
        <li><a href="{{ route('dbConfigAdmin.manage', [$url]) }}">{{ $page['name'] }}</a></li>
        @endforeach
        <li class="divider"></li>
        <li><a href="{{ route('dbConfigAdmin.logs') }}">Logs</a></li>
    </ul>
</li>