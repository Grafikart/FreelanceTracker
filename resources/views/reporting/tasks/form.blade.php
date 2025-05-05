<tr
    @if ($task->id)
        hx-swap="outerHTML"
        hx-target="this"
        id="task-{{ $task->id }}"
    @else
        hx-swap="afterend"
        hx-target="#form"
        id="form"
    @endif
>
    <td colspan="2">
        <form
            class="flex gap-2"
            hx-post="{{ $task->id ? route("tasks.update", $task) : route("tasks.store") }}"
            hx-trigger="submit"
            hx-on::after-request="if(event.detail.successful) this.reset()"
        >
            @csrf
            @if ($task->id)
                @method("put")
            @endif

            <div class="w-full">
                <input
                    placeholder="{{ __("task.create") }}"
                    type="text"
                    class="input w-full"
                    name="name"
                    value="{{ old("name", $task->name) }}"
                />
                @error("name")
                    <p class="label text-error mt-1 text-xs">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <button type="submit" class="btn btn-soft">
                @if ($task->id)
                    <span class="iconify lucide--save"></span>
                    {{ __("task.save") }}
                @else
                    <span class="iconify lucide--plus"></span>
                    {{ __("task.create") }}
                @endif
            </button>
        </form>
    </td>
</tr>
