import Alpine from "alpinejs";

Alpine.data("clipboard", (text: string) => ({
    copied: false,
    timer: null as null | ReturnType<typeof setTimeout>,
    baseText: "",

    init() {
        this.baseText = this.$el.innerText;
    },

    destroy() {
        if (this.timer) {
            clearTimeout(this.timer);
        }
    },

    get text() {
        return this.copied ? "Copied!" : this.baseText;
    },

    copy() {
        navigator.clipboard.writeText(text);
        this.copied = true;
        this.timer = setTimeout(() => (this.copied = false), 2000);
    },
}));
