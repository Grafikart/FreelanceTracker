<header class="navbar bg-base-100 shadow-sm">
    <div class="container">
        <ul class="menu menu-horizontal">
            <li
                @class([
                    "menu-active" => request()->routeIs("projects.*"),
                ])
            >
                <a href="{{ route("projects.index") }}">
                    {{ __("menu.projects") }}
                </a>
            </li>
            <li
                @class([
                    "menu-active" => request()->routeIs("tasks.*"),
                ])
            >
                <a href="{{ route("tasks.index") }}">
                    {{ __("menu.tasks") }}
                </a>
            </li>
        </ul>
    </div>
</header>
