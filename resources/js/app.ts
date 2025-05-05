import "../css/app.css";

import Alpine from "alpinejs";
import sort from "@alpinejs/sort";
import htmx from "htmx.org";
import "./components/rows";
import "./components/clipboard";
import "./directives/grow";
import "./directives/link";

Alpine.plugin(sort);

// @ts-expect-error used for devtools
window.Alpine = Alpine;

Alpine.start();

htmx.config.defaultSwapStyle = "outerHTML";
htmx.config.responseHandling = [
    { code: "[234]..", swap: true },
    { code: "[4]..", swap: true, error: true },
    { code: "[5]..", swap: false, error: true },
    { code: "...", swap: false },
];
