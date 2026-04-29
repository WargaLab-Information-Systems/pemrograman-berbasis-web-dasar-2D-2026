function ubahTema() {
  document.body.classList.toggle("bg-gray-900");
  document.body.classList.toggle("text-white");
}

function bukaSignup() {
  document.getElementById("signupMenu").classList.remove("hidden");
}

function tutupSignup() {
  document.getElementById("signupMenu").classList.add("hidden");
}
function validasiSignup() {
  let nama = document.getElementById("namaSignup").value;
  let email = document.getElementById("emailSignup").value;
  let password = document.getElementById("passwordSignup").value;

  document.getElementById("errorNama").innerText = "";
  document.getElementById("errorEmail").innerText = "";
  document.getElementById("errorPassword").innerText = "";

  let valid = true;

  if (nama == "") {
    document.getElementById("errorNama").innerText = "Nama harus diisi";
    valid = false;
  }

  if (email == "") {
    document.getElementById("errorEmail").innerText = "Email harus diisi";
    valid = false;
  } else if (!email.includes("@")) {
    document.getElementById("errorEmail").innerText = "Email tidak valid";
    valid = false;
  }

  if (password == "") {
    document.getElementById("errorPassword").innerText = "Password harus diisi";
    valid = false;
  } else if (password.length < 6) {
    document.getElementById("errorPassword").innerText = "Minimal 6 karakter";
    valid = false;
  }

  if (valid) {
    alert("Berhasil daftar!");

    tutupSignup();

    document.getElementById("namaSignup").value = "";
    document.getElementById("emailSignup").value = "";
    document.getElementById("passwordSignup").value = "";
  }
}
