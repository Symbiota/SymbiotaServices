import axios from "axios";
import htmx from "htmx.org";
import Alpine from "alpinejs";
window.axios = axios;
window.htmx = htmx;
window.Alpine = Alpine;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
Alpine.start();
