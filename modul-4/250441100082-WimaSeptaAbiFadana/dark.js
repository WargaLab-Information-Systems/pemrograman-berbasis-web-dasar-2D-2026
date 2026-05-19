document.addEventListener("DOMContentLoaded", () => {
    const html = document.documentElement;
    const toggleBtn = document.getElementById("themeToggle");

    // default
    if (!localStorage.getItem("theme")) {
        localStorage.setItem("theme", "light");
    }

    // apply
    if (localStorage.getItem("theme") === "dark") {
        html.classList.add("dark");
        toggleBtn.textContent = "☀️";
    } else {
        html.classList.remove("dark");
        toggleBtn.textContent = "🌙";
    }

    // toggle
    toggleBtn.addEventListener("click", () => {
        html.classList.toggle("dark");

        if (html.classList.contains("dark")) {
            localStorage.setItem("theme", "dark");
            toggleBtn.textContent = "☀️";
        } else {
            localStorage.setItem("theme", "light");
            toggleBtn.textContent = "🌙";
        }
    });
});




const form = document.getElementById("loginForm");
const emailInput = document.getElementById("email");
const passwordInput = document.getElementById("password");
const emailError = document.getElementById("emailError");
const passwordError = document.getElementById("passwordEror");

form.addEventListener("submit",function(e){
    e.preventDefault();

    let valid = true;

    emailError.classList.add("hidden");
    passwordError.classList.add("hidden");

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(emailInput.value)) {
        emailError.classList.remove("hidden");
        valid = false;
    }

    if (passwordInput.value.length < 6) {
        passwordError.classList.remove("hidden");
        valid = false;
    }

    if (valid) {
        alert("Login berhasil!");
        form.reset();
    }
})