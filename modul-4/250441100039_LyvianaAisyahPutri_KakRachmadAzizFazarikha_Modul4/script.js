const elemenHtml = document.querySelector('html');
const tombolUbahTema = document.getElementById('btnTema');

if (tombolUbahTema !== null) {
    tombolUbahTema.addEventListener('click', function() {

        elemenHtml.classList.toggle('dark');


        if (elemenHtml.classList.contains('dark')) {
            tombolUbahTema.innerText = '☀️ Mode Terang';
        } else {
            tombolUbahTema.innerText = '🌑 Mode Gelap';
        }
    });
}

const formulir = document.getElementById('formLogin');
const inputEmail = document.getElementById('emailInput');
const inputSandi = document.getElementById('passwordInput');

if (formulir !== null) {
    formulir.addEventListener('submit', function(e) {
        e.preventDefault();

        if (inputEmail.value.length === 0 || inputSandi.value.length === 0) {
            alert("Harap isi email dan password terlebih dahulu!");
        } else {
            alert("Login Berhasil! Mengarahkan ke halaman utama...");
            window.location.assign('index.html'); 
        }
    });
}