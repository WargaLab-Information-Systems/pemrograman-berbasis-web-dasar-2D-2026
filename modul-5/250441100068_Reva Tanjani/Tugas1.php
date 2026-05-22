<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class=" bg-[url('bg.jpg')] bg-fixed bg-cover bg-center">
<nav class=" outline-1 outline-gray-600 flex bg-neutral-900 w-screen shadow-xl fixed top-0 z-100 h-17"> <div class="bg-yellow-400 place-items-center mx-auto w-100 h-1 mt-8 outline-3 outline-neutral-900"><h1 class="absolute top-4  text-xl font-bold italic text-center text-olive-100">PROFIL INTERAKTIF DEVELOPER PEMULA</h1></div></nav>
<div class="mt-20 bg-neutral-900 rounded-b-xl shadow-md w-100 h-60 mx-auto py-5 outline-1 outline-gray-400 ">
  <div class=""><h1 class= "top-0 text-2xl font-bold italic text-center text-yellow-300">PROFIL</h1></div><table class="mt-4 w-90  mx-auto border-grey-200 shadow-md outline-1 outline-gray-300">
<tr class=" bg-gray-300"><td class="px-3 font-semibold italic">Nama</td>
<td >Reva</td>
  </tr>
<tr class="bg-olive-100">
<td class="px-3 font-semibold italic">ID Developer</td>
<td >250441100068</td>
  </tr>
  <tr class="bg-gray-300"><td class="px-3 font-semibold italic">Kota</td><td >Nganjuk</td>
  </tr>
  <tr class="bg-olive-100">
    <td class="px-3 font-semibold italic">Email</td>
    <td >revatanjani@gmail.com</td>
  </tr>
  <tr class="bg-gray-300">
    <td class="px-3 font-semibold italic">No.WhatsApp</td>
    <td >081249144908</td>
  </tr>
    </table>
    </div>

<div class="mt-20 bg-neutral-900 rounded-b-xl shadow-md mx-auto py-5 px-80 outline-1 outline-gray-400">
  <div class=""><h1 class= "top-0 text-2xl font-bold italic text-center text-yellow-300 py-1">FORM</h1></div>
  <form action="" class="text-olive-100 mt-2 px-3" method="POST">
  <div class="mt-3 group relative">
  <label class="text-gray-500 group-hover:text-olive-100 group-hover:text-start font-semibold py-1 absolute bottom-2 group-hover:bottom-9 transition-all   duration-200 w-220">Framework</label>
  <input type="text" name="framework" class="w-full p-2 border-b border-yellow-300/50 hover:border-b hover:border-yellow-300 focus-within:outline-1"></div>
<div class="mt-5">
<label class="text-gray-500 font-semibold py-1">Cerita singkat pengalaman membuat website</label>
<textarea name="cerita" class="w-full border border-yellow-300/50 hover:border hover:border-yellow-300 p-2 rounded focus-within:outline-1 h-20 focus-within:shadow-yellow-300"></textarea></div>

<p class="text-gray-500 ">Minat Bidang</p>
<div class="flex gap-3">  
<label class="cursor-pointer group"> 
  <input type="radio" name="pilihan" class="hidden peer" value="fronted"><div class="font-bold translate-y-3 hover:translate-y-1 transition-all duration-400 h-10 w-40 text-neutral-900 bg-olive-100 rounded peer-checked:text-olive-100 peer-checked:bg-yellow-400 flex items-center justify-center">Fronted
  </div>
</label>
    <label class="cursor-pointer group"> 
  <input type="radio" name="pilihan" class="hidden peer" value="backend"><div class="font-bold translate-y-3 hover:translate-y-1 transition-all duration-400 h-10 w-40 text-neutral-900 bg-olive-100 rounded peer-checked:text-olive-100 peer-checked:bg-yellow-400 flex items-center justify-center">Backend
  </div>
</label><label class="cursor-pointer group"> 
  <input type="radio" name="pilihan" class="hidden peer" value="fullstack"><div class="font-bold translate-y-3 hover:translate-y-1 transition-all duration-400 h-10 w-40 text-neutral-900 bg-olive-100 rounded peer-checked:text-olive-100 peer-checked:bg-yellow-400 flex items-center justify-center">Fullstack
  </div>
</label>
</div>
<p class="text-gray-500 mt-3">Tools Penunjang</p>
<div class="flex gap-3">  
<label class="cursor-pointer group"> 
  <input type="checkbox" name="tools[]" class="hidden peer" value="Vs code"><div class="font-bold translate-y-3 hover:translate-y-1 transition-all duration-400 h-10 w-40 text-neutral-900 bg-olive-100 rounded peer-checked:text-olive-100 peer-checked:bg-yellow-400 flex items-center justify-center">Vs Code
  </div>
</label><label class="cursor-pointer group"> 
  <input type="checkbox" name="tools[]" class="hidden peer" value="GitHub"><div class="font-bold translate-y-3 hover:translate-y-1 transition-all duration-400 h-10 w-40 text-neutral-900 bg-olive-100 rounded peer-checked:text-olive-100 peer-checked:bg-yellow-400 flex items-center justify-center">GitHub
  </div>
</label><label class="cursor-pointer group"> 
  <input type="checkbox" name="tools[]" class="hidden peer" value="Figma"><div class="font-bold translate-y-3 hover:translate-y-1 transition-all duration-400 h-10 w-40 text-neutral-900 bg-olive-100 rounded peer-checked:text-olive-100 peer-checked:bg-yellow-400 flex items-center justify-center">Figma
  </div>
</label>
 <label class="cursor-pointer group"> 
  <input type="checkbox" name="tools[]" class="hidden peer" value="Postman"><div class="font-bold translate-y-3 hover:translate-y-1 transition-all duration-400 h-10 w-40 text-neutral-900 bg-olive-100 rounded peer-checked:text-olive-100 peer-checked:bg-yellow-400 flex items-center justify-center">Postman
  </div>
</label>
</div>
<select name="tingkat" class="w-100 outline-1 mt-6 outline-yellow-300/50 focus:outline-yellow-300 rounded w-215 ">
<option value="" disabled selected class="">Tingkat Skill</option>
<option value="Dasar">Dasar</option>
<option value="cukup">Cukup</option>
<option value="Profesional">Profesional</option>
</select>
<button type="submit" name="submit" class="mt-6 font-bold hover:text-olive-100 hover:bg-yellow-400 transition-all duration-400 h-10 w-full text-neutral-900 bg-olive-100 rounded items-center justify-center">submit
</button>
  </form>
</div>
</body>
</html>

<?php
if(isset($_POST['submit'])){
$fw = $_POST['framework'] ?? '';
   $cerita = $_POST['cerita'] ?? '';
$minat = $_POST['pilihan'] ?? '';
    $tools = $_POST['tools'] ?? [];
    $tingkat = $_POST['tingkat'] ?? '';

    if(!$fw || !$cerita || !$minat || !$tools || !$tingkat){
        echo "<p>Semua data harus diisi!</p>";
    } else {
    $fw = explode(",", $fw);
  echo "<div style='background:black;color:white;padding:20px;margin-top:20px'>";
  echo "<h3>HASIL INPUT</h3>";
echo "<b>Framework:</b> ";  foreach($fw as $x){
    echo $x . " ";
        }
          echo "<br><b>Minat:</b> $minat";
  echo "<br><b>Tools:</b> ";
foreach($tools as $t){
 echo $t . " ";
        }
  echo "<br><b>Skill:</b> $tingkat";
echo "<br><b>Cerita:</b><br>$cerita";
echo "</div>";
    }
}
?>