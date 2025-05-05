<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>{{ $title ?? config("app.name") }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@100..900&display=swap"
            rel="stylesheet"
        />

        @vite(["resources/js/app.ts"])
        @yield("head")
    </head>
    <body
        class="font-sans antialiased"
        data-theme="{{ Auth::user()?->theme }}"
    >
        @if (session("success"))
            <div
                role="alert"
                class="alert alert-vertical alert-success sm:alert-horizontal fixed top-4 right-4 z-50 w-max max-w-100 shadow-md"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 shrink-0 stroke-current"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                </svg>
                <div>{{ session("success") }}</div>
                <button
                    class="btn btn-square btn-ghost -mr-2 self-start"
                    onclick="this.parentElement.remove()"
                >
                    &times;
                </button>
            </div>
        @endif

        @auth
            <header class="navbar bg-primary text-primary-content/70 shadow-sm">
                <div class="container flex items-center">
                    <a
                        href=""
                        @class(["btn btn-ghost", "menu-active" => request()->routeIs("dashboard")])
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="size-[1.2em]"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                        >
                            <path
                                d="M13 19H19V9.97815L12 4.53371L5 9.97815V19H11V13H13V19ZM21 20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V9.48907C3 9.18048 3.14247 8.88917 3.38606 8.69972L11.3861 2.47749C11.7472 2.19663 12.2528 2.19663 12.6139 2.47749L20.6139 8.69972C20.8575 8.88917 21 9.18048 21 9.48907V20Z"
                            ></path>
                        </svg>
                    </a>
                    <ul class="menu menu-horizontal -ml-3">
                        <li>
                            <a
                                href="{{ route("projects.index") }}"
                                class="{{ request()->routeIs("projects.*") ? "menu-active" : "" }}"
                            >
                                {{ __("menu.projects") }}
                            </a>
                        </li>
                        <li>
                            <a
                                href="{{ route("clients.index") }}"
                                class="{{ request()->routeIs("clients.*") ? "menu-active" : "" }}"
                            >
                                {{ __("menu.clients") }}
                            </a>
                        </li>
                        <li>
                            <a
                                href="{{ route("estimates.index") }}"
                                class="{{ request()->routeIs("estimates.*") ? "menu-active" : "" }}"
                            >
                                {{ __("menu.estimates") }}
                            </a>
                        </li>
                        <li>
                            <a
                                href="{{ route("clients.index") }}"
                                class="{{ request()->routeIs("clients.*") ? "menu-active" : "" }}"
                            >
                                {{ __("menu.clients") }}
                            </a>
                        </li>
                    </ul>

                    {{-- User Dropdown --}}
                    <div class="dropdown dropdown-bottom dropdown-end ml-auto">
                        <div
                            tabindex="0"
                            role="button"
                            class="btn btn-ghost rounded-btn px-1.5"
                        >
                            <div class="flex items-center gap-2">
                                <div class="avatar">
                                    <div
                                        class="bg-base-200 mask mask-squircle w-8"
                                    >
                                        <img
                                            alt="Avatar"
                                            src="{{ Auth::user()->avatar }}"
                                        />
                                    </div>
                                </div>
                                <div class="-space-y-0.5 text-start">
                                    <p class="max-w-30 truncate text-sm">
                                        {{ Auth::user()->company_name }}
                                    </p>
                                    <p class="text-xs opacity-60">
                                        {{ __("settings.title") }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="dropdown-content bg-base-100 rounded-box text-base-content mt-4 w-44 shadow"
                            tabindex="0"
                        >
                            <ul class="menu w-full p-2">
                                <li>
                                    <a href="{{ route("settings") }}">
                                        <span
                                            class="iconify lucide--settings size-4"
                                        ></span>
                                        <span>{{ __("settings.title") }}</span>
                                    </a>
                                </li>
                            </ul>
                            <hr class="border-base-300" />
                            <ul class="menu w-full p-2">
                                <li>
                                    <form
                                        action="{{ route("logout") }}"
                                        id="logout"
                                        method="post"
                                        hidden
                                    >
                                        @csrf
                                    </form>
                                    <button
                                        type="submit"
                                        class="text-error hover:bg-error/10"
                                        form="logout"
                                    >
                                        <span
                                            class="iconify lucide--log-out size-4"
                                        ></span>
                                        <span>Logout</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
        @endauth

        @yield("root")

        <div class="container py-8">
            @yield("body")
        </div>

        @yield("script")
    </body>
</html>
