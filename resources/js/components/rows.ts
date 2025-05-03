import Alpine from "alpinejs";

type Row = {
    label: string;
    quantity: number;
    price: number;
    position: number;
};

Alpine.data(
    "rows",
    (props: { rows: Row[]; tax: number; currency: string }) => ({
        rows: [] as Row[],
        tax: props.tax,
        currency: props.currency,

        init() {
            if (props.rows.length === 0) {
                this.rows = [{ label: "", quantity: 1, price: 0, position: 0 }];
                return;
            }

            this.rows = props.rows.map((row, k) => {
                return {
                    ...row,
                    price: row.price / 100,
                    position: k,
                };
            });
        },

        reorder(e: { oldIndex: number; newIndex: number }) {
            console.log(e);
            // The row was not moved
            if (e.newIndex === e.oldIndex) {
                return;
            }

            const movedRow = this.rows.find(
                (row) => row.position === e.oldIndex,
            );
            if (!movedRow) {
                throw new Error(`Row #${e.oldIndex} not found`);
            }

            // We are moving the row up
            if (e.newIndex > e.oldIndex) {
                this.rows
                    .filter(
                        (r) =>
                            r.position > e.oldIndex && r.position <= e.newIndex,
                    )
                    .forEach((r) => r.position--);
            } else {
                this.rows
                    .filter(
                        (r) =>
                            r.position < e.oldIndex && r.position >= e.newIndex,
                    )
                    .forEach((r) => r.position++);
            }
            movedRow.position = e.newIndex;
        },

        addRow() {
            this.rows.push({
                label: "",
                quantity: 1,
                price: 0,
                position: this.rows.length,
            });
        },

        get total() {
            return this.rows.reduce(
                (acc, row) => acc + row.price * row.quantity,
                0,
            );
        },

        get totalTax() {
            return Math.round(this.total * this.tax) / 100;
        },

        formatPrice(price: number) {
            return new Intl.NumberFormat(undefined, {
                style: "currency",
                currency: this.currency,
            }).format(price);
        },
    }),
);
