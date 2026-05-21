document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("loginForm");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const emailError = document.getElementById("emailError");
    const passwordError = document.getElementById("passwordError");
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        let valid = true;
        emailError.classList.add("hidden");
        passwordError.classList.add("hidden");
        email.classList.remove("border-red-500");
        password.classList.remove("border-red-500");
        if (email.value.trim() === "") {
            emailError.textContent = "Email tidak boleh kosong";
            emailError.classList.remove("hidden");
            email.classList.add("border", "border-red-500");
            valid = false;
        } else if (!/^[a-zA-Z0-9]+@gmail\.com$/.test(email.value)) {
            emailError.textContent = "Harus menggunakan email Gmail (@gmail.com) Dan tidak boleh ada simbol di depannya";
            emailError.classList.remove("hidden");
            email.classList.add("border", "border-red-500");
            valid = false;
        }
        if (password.value.trim() === "") {
            passwordError.textContent = "Password tidak boleh kosong";
            passwordError.classList.remove("hidden");
            password.classList.add("border", "border-red-500");
            valid = false;
        } else if (password.value.length < 6) {
            passwordError.textContent = "Password minimal 6 karakter";
            passwordError.classList.remove("hidden");
            password.classList.add("border", "border-red-500");
            valid = false;
        }
        if (valid) {
            alert("Login berhasil!");
            window.location.href = "uts.html";
        }
    });
    email.addEventListener("input", () => {
        emailError.classList.add("hidden");
        email.classList.remove("border-red-500");
    });
    password.addEventListener("input", () => {
        passwordError.classList.add("hidden");
        password.classList.remove("border-red-500");
    });
});