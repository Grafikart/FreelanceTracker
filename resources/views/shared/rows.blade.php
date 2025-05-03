<table class="table-zebra table">
    <thead>
        <tr class="bg-base-300">
            <th>{{ __("estimate.row.label") }}</th>
            <th class="w-25">{{ __("estimate.row.quantity") }}</th>
            <th class="w-25">{{ __("estimate.row.price") }}</th>
            <th class="w-25">{{ __("estimate.row.total") }}</th>
        </tr>
    </thead>
    <tbody x-sort @sort="reorder">
        <template x-for="(value, index) in rows" :key="index">
            <tr x-sort:item="value">
                <td>
                    <div class="flex">
                        <button class="cursor-move pr-4" x-sort:handle>
                            <svg
                                class="size-4"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                            >
                                <path
                                    d="M8.5 7C9.32843 7 10 6.32843 10 5.5C10 4.67157 9.32843 4 8.5 4C7.67157 4 7 4.67157 7 5.5C7 6.32843 7.67157 7 8.5 7ZM8.5 13.5C9.32843 13.5 10 12.8284 10 12C10 11.1716 9.32843 10.5 8.5 10.5C7.67157 10.5 7 11.1716 7 12C7 12.8284 7.67157 13.5 8.5 13.5ZM10 18.5C10 19.3284 9.32843 20 8.5 20C7.67157 20 7 19.3284 7 18.5C7 17.6716 7.67157 17 8.5 17C9.32843 17 10 17.6716 10 18.5ZM15.5 7C16.3284 7 17 6.32843 17 5.5C17 4.67157 16.3284 4 15.5 4C14.6716 4 14 4.67157 14 5.5C14 6.32843 14.6716 7 15.5 7ZM17 12C17 12.8284 16.3284 13.5 15.5 13.5C14.6716 13.5 14 12.8284 14 12C14 11.1716 14.6716 10.5 15.5 10.5C16.3284 10.5 17 11.1716 17 12ZM15.5 20C16.3284 20 17 19.3284 17 18.5C17 17.6716 16.3284 17 15.5 17C14.6716 17 14 17.6716 14 18.5C14 19.3284 14.6716 20 15.5 20Z"
                                ></path>
                            </svg>
                        </button>
                        <textarea
                            x-grow
                            class="textarea min-h-auto w-full"
                            rows="1"
                            type="text"
                            x-model="value.label"
                        ></textarea>
                    </div>
                </td>
                <td>
                    <input
                        class="input text-end"
                        type="text"
                        x-model="value.quantity"
                    />
                </td>
                <td>
                    <input
                        class="input text-end"
                        type="text"
                        x-model="value.price"
                    />
                </td>
                <td>
                    <div class="flex items-center gap-4">
                        <span
                            x-text="formatPrice(value.price * value.quantity)"
                        ></span>
                        <button class="btn btn-square btn-sm">&times;</button>
                    </div>
                </td>
            </tr>
        </template>
    </tbody>
</table>

<div class="flex justify-between">
    <button type="button" class="btn" @click="addRow">
        &plus; {{ __("estimate.add_row") }}
    </button>

    <table class="text-end text-sm">
        <tbody>
            <tr>
                <td class="pr-6">
                    {{ __("estimate.subtotal") }}
                </td>
                <td class="py-1">
                    <span x-text="formatPrice(total)"></span>
                </td>
            </tr>

            <tr>
                <td class="pr-6">
                    {{ __("estimate.tax") }} (
                    <span x-text="tax"></span>
                    %)
                </td>
                <td class="py-1" x-text="formatPrice(totalTax)"></td>
            </tr>

            <tr class="text-base-content text-xl font-bold">
                <td class="pr-6">{{ __("estimate.total") }}</td>
                <td class="py-1" x-text="formatPrice(total + totalTax)"></td>
            </tr>
        </tbody>
    </table>
</div>
