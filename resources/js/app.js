import "./bootstrap";

import Alpine from "alpinejs";
import Swal from "sweetalert2";

window.Alpine = Alpine;
window.Swal = Swal;

// Tambahkan fungsi global untuk menampilkan loading
window.showLoading = function (message = "Memproses...") {
    Swal.fire({
        title: "Memproses...",
        html: message,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        },
    });
};

// Tambahkan fungsi global untuk menampilkan pesan sukses
window.showSuccess = function (message) {
    Swal.fire({
        title: "Berhasil!",
        text: message,
        icon: "success",
        confirmButtonText: "OK",
        timer: 3000,
        timerProgressBar: true,
    });
};

// Tambahkan fungsi global untuk menampilkan pesan error
window.showError = function (message) {
    Swal.fire({
        title: "Gagal!",
        text: message,
        icon: "error",
        confirmButtonText: "OK",
        timer: 3000,
        timerProgressBar: true,
    });
};

Alpine.start();
