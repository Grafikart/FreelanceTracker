import Alpine from 'alpinejs'

// Make a tr clickable
Alpine.directive('link', (el: HTMLElement, {expression}) => {
    el.querySelectorAll('td').forEach(td => {
        td.classList.add('relative')
        const a = document.createElement('a')
        a.classList.add('absolute', 'inset-0', 'w-full', 'h-full')
        a.setAttribute('href', expression)
        td.appendChild(a)
    })
})
