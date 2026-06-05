document.addEventListener('DOMContentLoaded', () => {
    setupTema();          
    setupValidasiLogin(); 
});

function setupTema() {
    const root = document.documentElement;
    const tombolTema = document.getElementById('themeToggle');

    const temaTersimpan = localStorage.getItem('theme') || 'light';
    
    setTema(temaTersimpan, root, tombolTema);

    if (!tombolTema) return;

    tombolTema.addEventListener('click', () => {
        const sekarangDark = root.classList.contains('dark');
        const temaBaru = sekarangDark ? 'light' : 'dark';
        setTema(temaBaru, root, tombolTema);
    });
}

function setTema(tema, root, tombolTema) {
  root.classList.toggle('dark', tema === 'dark');
  localStorage.setItem('theme', tema);

  if (tombolTema) {
    tombolTema.textContent = tema === 'dark' ? 'Mode Terang' : 'Mode Gelap';
  }
}

function setupValidasiLogin() {
    const form = document.getElementById('loginForm');
    
    if (!form) return;

    const nama = document.getElementById('name');
    const email = document.getElementById('email');
    const password = document.getElementById('password');

    const errNama = document.getElementById('nameError');
    const errEmail = document.getElementById('emailError');
    const errPassword = document.getElementById('passwordError');
    
    const sukses = document.getElementById('successMessage');

    const validasiNama = () => {
        const v = nama.value.trim(); 
        if (v === '') return (errNama.textContent = 'Nama wajib diisi.'), false;
        if (v.length < 3) return (errNama.textContent = 'Nama minimal 3 karakter.'), false;
        errNama.textContent = '';
        return true;
    };

    const validasiEmail = () => {
        const v = email.value.trim();
        const polaEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (v === '') return (errEmail.textContent = 'Email wajib diisi.'), false;
        if (!polaEmail.test(v)) return (errEmail.textContent = 'Format email belum valid.'), false;
        errEmail.textContent = '';
        return true;
    };

    const validasiPassword = () => {
        const v = password.value;
        if (v.trim() === '') return (errPassword.textContent = 'Password wajib diisi.'), false;
        if (v.length < 6) return (errPassword.textContent = 'Password minimal 6 karakter.'), false;
        errPassword.textContent = '';
        return true;
    };

    nama.addEventListener('input', validasiNama);
    email.addEventListener('input', validasiEmail);
    password.addEventListener('input', validasiPassword);
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const ok = validasiNama() && validasiEmail() && validasiPassword();

        if (ok) {
            sukses.textContent = 'Login berhasil!'; 
            form.reset(); 
        } else {
            sukses.textContent = '';
        }
    });
}