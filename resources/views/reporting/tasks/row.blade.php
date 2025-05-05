<tr id="task-{{ $task->id }}" hx-swap="outerHTML" hx-target="this">
    <td>{{ $task->name }}</td>

    <td class="w-50">
        <div class="flex justify-end gap-2">
            <button
                hx-get="{{ route("tasks.edit", $task) }}"
                class="btn btn-soft btn-sm btn-neutral"
            >
                <span class="iconify lucide--pen"></span>
                {{ __("task.edit") }}
            </button>
            @if ($task->trashed())
                <button
                    @htmxCsrf()
                    hx-delete="{{ route("tasks.destroy", $task) }}"
                    hx-target="#task-{{ $task->id }}"
                    hx-swap="delete"
                    class="btn btn-soft btn-sm btn-warning"
                >
                    <span class="iconify lucide--list-restart"></span>
                    {{ __("task.restore") }}
                </button>
            @else
                <button
                    @htmxCsrf()
                    hx-delete="{{ route("tasks.destroy", $task) }}"
                    hx-target="#task-{{ $task->id }}"
                    hx-swap="delete"
                    class="btn btn-soft btn-sm btn-error"
                >
                    <span class="iconify lucide--trash"></span>
                    {{ __("task.delete") }}
                </button>
            @endif
        </div>
    </td>
</tr>
