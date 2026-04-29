const loginForm = document.getElementById('loginForm');

if (loginForm) {
    const emailInput = document.getElementById('loginEmail');
    const passwordInput = document.getElementById('loginPassword');
    const emailErr = document.getElementById('emailErr');
    const passErr = document.getElementById('passErr');
    const loginSuccess = document.getElementById('loginSuccess');

    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        let isValid = true;

        emailErr.classList.add('hidden');
        passErr.classList.add('hidden');

        if (!emailInput.value.trim()) {
            emailErr.textContent = 'Email harus diisi';
            emailErr.classList.remove('hidden');
            isValid = false;
        } else if (!emailInput.value.includes('@gmail.com')) {
            emailErr.textContent = 'Email tidak valid';
            emailErr.classList.remove('hidden');
            isValid = false;
        }

        if (!passwordInput.value.trim()) {
            passErr.textContent = 'Password harus diisi';
            passErr.classList.remove('hidden');
            isValid = false;
        } else if (passwordInput.value.length < 6) {
            passErr.textContent = 'Password minimal 6 karakter';
            passErr.classList.remove('hidden');
            isValid = false;
        }

        if (isValid) {
            loginSuccess.classList.remove('hidden');
            setTimeout(() => {
                window.location.href = "landing.html";
            }, 1500);
        }
    });
}
const darkModeToggle = document.getElementById('darkModeToggle');
const darkModeText = document.getElementById('darkModeText');

if (darkModeToggle && darkModeText) {

    if (localStorage.getItem('darkMode') === 'true') {
        document.body.classList.add('dark');
        darkModeText.textContent = 'Light Mode';
    }

    darkModeToggle.addEventListener('click', () => {
        document.body.classList.toggle('dark');
        const isDark = document.body.classList.contains('dark');
        localStorage.setItem('darkMode', isDark);
        darkModeText.textContent = isDark ? 'Light Mode' : 'Dark Mode';
    });

}