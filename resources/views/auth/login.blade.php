@extends("base")

@section("body")
    <div class="flex h-screen w-full flex-col items-center justify-center">
        <div class="flex w-150 flex-col items-stretch p-6 md:p-8 lg:p-16">
            <h3
                class="mt-8 text-center text-xl font-semibold md:mt-12 lg:mt-24"
            >
                {{ __("auth.login") }}
            </h3>
            <h3 class="text-base-content/70 mt-2 text-center text-sm">
                {{ __("auth.subtitle") }}
            </h3>
            <form
                class="mt-6 space-y-4 md:mt-10"
                method="post"
                action="{{ route("login") }}"
            >
                @csrf
                <x-form.field
                    type="email"
                    name="email"
                    label="{{ __('auth.email') }}"
                    placeholder="{{ __('auth.email') }}"
                    icon="lucide--mail"
                />
                <x-form.field
                    type="password"
                    name="password"
                    label="{{ __('auth.password') }}"
                    placeholder="{{ __('auth.password') }}"
                    icon="lucide--key-round"
                />
                <div class="mt-4 flex items-center gap-3 md:mt-6">
                    <input
                        class="checkbox checkbox-sm"
                        name="remember"
                        aria-label="Checkbox example"
                        id="agreement"
                        type="checkbox"
                    />
                    <label for="agreement" class="text-sm">
                        {{ __("auth.rememberme") }}
                    </label>
                </div>
                <button
                    class="btn btn-primary btn-wide mt-4 max-w-full gap-3 md:mt-6"
                    type="submit"
                >
                    <span class="iconify lucide--log-in size-4"></span>
                    {{ __("auth.login") }}
                </button>
            </form>
        </div>
    </div>
@endsection
