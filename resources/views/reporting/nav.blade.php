<header class="navbar bg-base-100 shadow-sm">
    <div class="container">
        <ul class="menu menu-horizontal">
            <li>
                <a
                    @class([
                        "menu-active" => request()->routeIs("projects.*"),
                    ])
                    href="{{ route("projects.index") }}"
                >
                    {{ __("menu.projects") }}
                </a>
            </li>
            <li>
                <a
                    @class([
                        "menu-active" => request()->routeIs("tasks.*"),
                    ])
                    href="{{ route("tasks.index") }}"
                >
                    {{ __("menu.tasks") }}
                </a>
            </li>
        </ul>
    </div>
</header>
