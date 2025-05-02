@extends('base')

@section('body')
    <div class="w-full h-screen flex flex-col justify-center items-center">
        <div class="flex flex-col items-stretch p-6 md:p-8 lg:p-16 w-150">
            <h3 class="mt-8 text-center text-xl font-semibold md:mt-12 lg:mt-24">{{ __('auth.login') }}</h3>
            <h3 class="text-base-content/70 mt-2 text-center text-sm">
                {{ __('auth.subtitle') }}
            </h3>
            <form class="mt-6 md:mt-10 space-y-4" method="post" action="{{ route('login') }}">
                @csrf
                <x-form.field
                    type="email"
                    name="email"
                    label="{{ __('auth.email') }}"
                    placeholder="{{ __('auth.email') }}"
                >
                    <x-slot:icon>
                        <path d="M3 3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3ZM20 7.23792L12.0718 14.338L4 7.21594V19H20V7.23792ZM4.51146 5L12.0619 11.662L19.501 5H4.51146Z"></path>
                    </x-slot:icon>
                </x-form.field>
                <x-form.field
                    type="password"
                    name="password"
                    label="{{ __('auth.password') }}"
                    placeholder="{{ __('auth.password') }}"
                >
                    <x-slot:icon>
                        <path d="M10.7577 11.8281L18.6066 3.97919L20.0208 5.3934L18.6066 6.80761L21.0815 9.28249L19.6673 10.6967L17.1924 8.22183L15.7782 9.63604L17.8995 11.7574L16.4853 13.1716L14.364 11.0503L12.1719 13.2423C13.4581 15.1837 13.246 17.8251 11.5355 19.5355C9.58291 21.4882 6.41709 21.4882 4.46447 19.5355C2.51184 17.5829 2.51184 14.4171 4.46447 12.4645C6.17493 10.754 8.81633 10.5419 10.7577 11.8281ZM10.1213 18.1213C11.2929 16.9497 11.2929 15.0503 10.1213 13.8787C8.94975 12.7071 7.05025 12.7071 5.87868 13.8787C4.70711 15.0503 4.70711 16.9497 5.87868 18.1213C7.05025 19.2929 8.94975 19.2929 10.1213 18.1213Z"></path>
                    </x-slot:icon>
                </x-form.field>
                <div class="mt-4 flex items-center gap-3 md:mt-6">
                    <input class="checkbox checkbox-sm" name="remember" aria-label="Checkbox example" id="agreement" type="checkbox">
                    <label for="agreement" class="text-sm">
                        {{ __('auth.rememberme') }}
                    </label>
                </div>
                <button class="btn btn-primary btn-wide mt-4 max-w-full gap-3 md:mt-6" type="submit">
                    <span class="iconify lucide--log-in size-4"></span>
                    {{ __('auth.login') }}
                </button>
            </form>
        </div>
    </div>
@endsection
