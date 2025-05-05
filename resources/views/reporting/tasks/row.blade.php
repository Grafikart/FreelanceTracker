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
            <button
                hx-delete="{{ route("tasks.destroy", $task) }}"
                hx-target="#task-{{ $task->id }}"
                hx-swap="delete"
                hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'
                class="btn btn-soft btn-sm btn-error"
            >
                <span class="iconify lucide--trash"></span>
                {{ __("task.delete") }}
            </button>
        </div>
    </td>
</tr>
