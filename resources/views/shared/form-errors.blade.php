@if ($errors->any())
    <div role="alert" class="alert alert-error my-4">
        <svg
            class="h-6 w-6 shrink-0"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="currentColor"
        >
            <path
                d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM11 15H13V17H11V15ZM11 7H13V13H11V7Z"
            ></path>
        </svg>
        <div>
            <h3 class="font-bold">{{ __("form.error") }}</h3>
            <p class="text-xs">
                {{ __("form.error_count", ["count" => $errors->count()]) }}
            </p>
            <ul class="list-inside list-disc text-xs">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
