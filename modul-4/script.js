// DARK/LIGHT MODE TOGGLE
function toggleTheme() {
  const html = document.documentElement;
  const isDark = html.classList.contains('dark');
  if (isDark) {
    html.classList.remove('dark');
    localStorage.setItem('theme', 'light');
    document.getElementById('toggleIcon').textContent = '🌞';
  } else {
    html.classList.add('dark');
    localStorage.setItem('theme', 'dark');
    document.getElementById('toggleIcon').textContent = '🌙';
  }
}

// Load saved theme
(function () {
  const saved = localStorage.getItem('theme');
  if (saved === 'dark') {
    document.documentElement.classList.add('dark');
    document.getElementById('toggleIcon').textContent = '🌙';
  }
})();

// MODAL HELPERS
function closeModal(id) {
  document.getElementById(id).classList.add('hidden');
  // Reset forms
  const form = document.getElementById(id)?.querySelector('form');
  if (form) form.reset();
  clearErrors(id);
}

function clearErrors(modalId) {
  document.querySelectorAll('#' + modalId + ' [id$="_err"]').forEach(el => el.classList.add('hidden'));
  document.querySelectorAll('#' + modalId + ' input, #' + modalId + ' textarea').forEach(el => {
    el.classList.remove('border-red-500'); 
  });
}

// Close modal clicking backdrop
document.querySelectorAll('[id$="Modal"]').forEach(modal => {
  modal.addEventListener('click', function (e) {
    if (e.target === this) closeModal(this.id);
  });
});

// Close modal with Escape key
document.addEventListener('keydown', function (e) {
  if (e.key === 'Escape') {
    document.querySelectorAll('[id$="Modal"]').forEach(m => m.classList.add('hidden'));
  }
});

// VALIDATION HELPERS 
function showError(fieldId, errId) {
  const field = document.getElementById(fieldId);
  const err = document.getElementById(errId);
  if (field) field.classList.add('border-red-500');
  if (err) err.classList.remove('hidden');
  return false;
}

function clearError(fieldId, errId) {
  const field = document.getElementById(fieldId);
  const err = document.getElementById(errId);
  if (field) field.classList.remove('border-red-500');
  if (err) err.classList.add('hidden');
}

function isValidEmail(email) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

// CONTACT FORM VALIDATION 
function validateContactForm(e) {
  e.preventDefault();
  let valid = true;

  const name = document.getElementById('c_name').value.trim();
  const email = document.getElementById('c_email').value.trim();
  const phone = document.getElementById('c_phone').value.trim();
  const message = document.getElementById('c_message').value.trim();

  clearErrors('contactModal');

  if (name.length < 3) {
    showError('c_name', 'c_name_err'); valid = false;
  }
  if (!isValidEmail(email)) {
    showError('c_email', 'c_email_err'); valid = false;
  }
  if (!/^[0-9]{10,13}$/.test(phone)) {
    showError('c_phone', 'c_phone_err'); valid = false;
  }
  if (message.length < 10) {
    showError('c_message', 'c_message_err'); valid = false;
  }

  if (valid) {
    document.getElementById('contactForm').classList.add('hidden');
    document.getElementById('contactSuccess').classList.remove('hidden');
    setTimeout(() => {
      closeModal('contactModal');
      document.getElementById('contactForm').classList.remove('hidden');
      document.getElementById('contactSuccess').classList.add('hidden');
    }, 2500);
  }
}

// SIGN IN VALIDATION
function validateSignIn(e) {
  e.preventDefault();
  let valid = true;
  const email = document.getElementById('si_email').value.trim();
  const password = document.getElementById('si_password').value;

  clearErrors('signinModal');

  if (!isValidEmail(email)) {
    showError('si_email', 'si_email_err'); valid = false;
  }
  if (password.length < 6) {
    showError('si_password', 'si_password_err'); valid = false;
  }
  if (valid) {
    alert('Sign in successful! (demo)');
    closeModal('signinModal');
  }
}

// SIGN UP VALIDATION
function validateSignUp(e) {
  e.preventDefault();
  let valid = true;
  const name = document.getElementById('su_name').value.trim();
  const email = document.getElementById('su_email').value.trim();
  const password = document.getElementById('su_password').value;
  const confirm = document.getElementById('su_confirm').value;

  clearErrors('signupModal');

  if (name.length < 3) {
    showError('su_name', 'su_name_err'); valid = false;
  }
  if (!isValidEmail(email)) {
    showError('su_email', 'su_email_err'); valid = false;
  }
  if (password.length < 8) {
    showError('su_password', 'su_password_err'); valid = false;
  }
  if (password !== confirm) {
    showError('su_confirm', 'su_confirm_err'); valid = false;
  }
  if (valid) {
    alert('Account created successfully! (demo)');
    closeModal('signupModal');
  }
}

// Hook Sign In and Sign Up nav links
document.querySelectorAll('a[href="#"]').forEach(link => {
  if (link.textContent.trim() === 'Sign In') {
    link.onclick = function (e) { e.preventDefault(); document.getElementById('signinModal').classList.remove('hidden'); };
  }
  if (link.textContent.trim() === 'Sign Up') {
    link.onclick = function (e) { e.preventDefault(); document.getElementById('signupModal').classList.remove('hidden'); };
  }
});