require('./bootstrap');
import $ from "jquery";
window.$ = window.jQuery = $;
import Swal from "sweetalert2";

window.Swal = Swal

const toast = Swal.mixin({
    icon: "success",
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000
});
window.toast = toast;

require('datatables.net-bs4');
require('datatables.net-buttons-bs4');
