document.getElementById("btnLogin").addEventListener("click", function (event) {
  event.preventDefault();
  var user = document.getElementById("emailUser").value;
  var pass = document.getElementById("passwordUser").value;
  
  if (user === "vasyah" && pass === "123123") {
    alert("Login Berhasil!");
    window.location.href = "main.html";
  } else {
    alert("Username atau Password Salah!");
  }
});

