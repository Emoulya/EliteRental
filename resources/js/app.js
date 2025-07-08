import "./bootstrap";

import Alpine from "alpinejs";
import Swal from "sweetalert2";

window.Alpine = Alpine;
window.Swal = Swal;

// Fungsi global untuk menampilkan loading
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

// Fungsi global untuk menampilkan pesan sukses
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

// Fungsi global untuk menampilkan pesan error
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

// Fungsi global untuk konfirmasi penghapusan
window.confirmAndDelete = function (form, title, htmlText) {
    Swal.fire({
        title: title,
        html: htmlText,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#e3342f",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            showLoading("Memproses penghapusan..."); // Gunakan fungsi global yang sudah ada
            form.submit();
        }
    });
};

Alpine.start();
