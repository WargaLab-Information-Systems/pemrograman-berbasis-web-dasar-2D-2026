document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById("tema");
    if (localStorage.getItem("") === "dark") {
        document.documentElement.classList.add("dark");
        btn.textContent = "Light";
    } else {
        btn.textContent = "Dark";
    }
    btn.addEventListener("click", () => {
        document.documentElement.classList.toggle("dark");
        if (document.documentElement.classList.contains("dark")) {
            localStorage.setItem("", "dark");
            btn.textContent = "Light";
        } else {
            localStorage.setItem("", "light");
            btn.textContent = "Dark";
        }
    });
});