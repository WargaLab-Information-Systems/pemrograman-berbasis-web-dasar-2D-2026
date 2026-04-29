const btnTema = document.getElementById('btnTema');
const htmlTag = document.documentElement;

if (btnTema) {
    btnTema.addEventListener('click', function() {
        htmlTag.classList.toggle('dark');
        if (htmlTag.classList.contains('dark')) {
            btnTema.textContent = '☀️ Light Mode';
        } else {
            btnTema.textContent = '🌙 Dark Mode';
        }
    });
}






const tombolBelumAktif = document.querySelectorAll('a[href="#"]');
const tombolSudahAktif = document.querySelectorAll('a[href="##"]');
const tombolLoginAktif = document.querySelectorAll('a[href="login.html"]');

tombolBelumAktif.forEach(function(tombol) {
    tombol.addEventListener('click', function(event) {
        event.preventDefault(); 
        alert("Tombol dummy mas gabakal ngaruh!😂");
    });
});

tombolSudahAktif.forEach(function(tombol) {
    tombol.addEventListener('click', function(event) {
        event.preventDefault(); 
        alert("Sudah ditempatnya gausah di klik🗿");
    });
});

tombolLoginAktif.forEach(function(tombol) {
    tombol.addEventListener('click', function(event) {
        event.preventDefault(); 
    
        const okekatanya = confirm("Login dulu gasih?");
        if (okekatanya) {
            window.location.href = 'login.html'; 
        } 
        else {
            alert("Yahh kecewa ringan😓"); 
        }
    });
});





const formLogin = document.getElementById('formLogin');
const emailInput = document.getElementById('emailInput');
const passwordInput = document.getElementById('passwordInput');

if (formLogin) {
    formLogin.addEventListener('submit', function(event) {
        event.preventDefault();

        if (emailInput.value === '' || passwordInput.value === '') {
            alert("Email dan password tidak sesuai!");
        } else {
            alert("Login Berhasil!");
            window.location.href = 'index.html'; 
        }
    });
}

