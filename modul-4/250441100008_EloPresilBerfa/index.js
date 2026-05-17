let tombol1 = document.getElementById("mode");
let modeText = document.getElementById("mode-text");

tombol1.addEventListener("click", function () {
    document.documentElement.classList.toggle("dark");
    
    if (document.documentElement.classList.contains("dark")) {
        modeText.textContent = "Light Mode";
    } else {
        modeText.textContent = "Dark Mode";
    }
});

