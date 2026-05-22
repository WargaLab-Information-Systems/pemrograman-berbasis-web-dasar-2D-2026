
warna = document.querySelectorAll('.warna');
warna2 = document.querySelectorAll('.warna2')
warnatext = document.querySelectorAll('.warnatext')
button = document.querySelectorAll('.button')
nav = document.querySelectorAll('.nav')

ganti.addEventListener("click", function(){
    for (let i = 0; i < warna.length; i++){
        warna[i].classList.toggle('bg-linear-to-bl')
        warna[i].classList.toggle('from-neutral-950');
         warna[i].classList.toggle('to-neutral-900');
    }
});

ganti.addEventListener("click", function(){
    for (let i = 0; i < warnatext.length; i++){
        warnatext[i].classList.toggle('text-olive-100');
    }
});

ganti.addEventListener("click",function()
{
    for (let i = 0; i < warna2.length;i++){
        warna2[i].classList.remove('bg-amber-200');
        warna2[i].classList.toggle('bg-indigo-950')
        warna2[i].classList.toggle('bg-amber-200')
    }
})

ganti.addEventListener("click",function()
{
    for (let i = 0; i < button.length;i++){
   if (button[i].classList.contains('bg-orange-400')){
            (button[i].classList.remove('bg-orange-400'));
             (button[i].classList.add('bg-indigo-900'));
        }
    else if (button[i].classList.contains('bg-indigo-900')){
            (button[i].classList.remove('bg-indigo-900'));
             (button[i].classList.add('bg-orange-400'));
        }
    }
    
});

ganti.addEventListener("click",function()
{
    for (let i = 0; i < nav.length;i++){
   if (nav[i].classList.contains('bg-olive-100')){
            (nav[i].classList.remove('bg-olive-100'));
             (nav[i].classList.add('bg-indigo-950'));
        }
    else if (nav[i].classList.contains('bg-indigo-950')){
            (nav[i].classList.remove('bg-indigo-950'));
             (nav[i].classList.add('bg-olive-100'));
        }
    }
});

let btn = document.getElementById("signed");
let form = document.getElementById("formHP");

btn.addEventListener("click", function() {
  form.classList.toggle("hidden");
});


function validasiHP() {
  let hp = document.getElementById("hp").value; 
  if (hp === "") {alert("Nomor HP tidak boleh kosong!");return false;
  }

  for (let i = 0; i < hp.length; i++) {
    if (hp[i] < "0" || hp[i] > "9") {
alert("Nomor HP harus angka semua!");
form.classList.toggle("hidden")
      return false;
    }
  }

  if (hp.length < 10 || hp.length > 13) {
    alert("Nomor HP harus 10 - 13 digit!");
    form.classList.toggle("hidden")
    return false;
  }
  alert("Nomor Hp terkirim!");
  form.classList.toggle("hidden");
  return true;
}
