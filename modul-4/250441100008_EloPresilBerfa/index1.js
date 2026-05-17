let tombol = document.getElementById("tombol");
tombol.addEventListener("click", function () {
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    
    if (email === "" || password === "") {
        alert("Mohon isi email dan password!");
    } else {
        alert("Anda Berhasil Login!");
    }
});

let tombol2 = document.getElementById("google");
tombol2.addEventListener("click", function () {
    alert("Anda Berhasil Login");
});