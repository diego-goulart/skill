
<ul class="nav navbar-nav">
    &nbsp;@can('role_admin')
    <li>
        {!! link_to_route('admin.roles.index', 'Roles')!!}
    </li>



    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            Permissões <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
            <li>
                {!! link_to_route('admin.permissions.index', $title = 'Listar')!!}
            </li>
            <li>
                {!! link_to_route('admin.permissions.create', $title = 'Cadastrar')!!}
            </li>
        </ul>
    </li>
    @endcan
    @can('group_admin')
        <li><a href="{{route('admin.groups.index')}}">Equipes</a></li>
    @endcan
    @can('user_manager')
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            Usuários <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
            <li>
                {!! link_to_route('admin.users.index', $title = 'Listar')!!}
            </li>
            <li>
                {!! link_to_route('admin.users.create', $title = 'Cadastrar')!!}
            </li>
        </ul>
    </li>
    @endcan

    @can('questions_admin')
    <li><a href="{{route('admin.questions.index')}}">Avaliações </a></li>
    @endcan

    @can('report_manager')
        <li><a href="{{route('admin.reports.index')}}">Monitorias </a></li>
    @endcan

</ul>