<!Doctype html>
<html>
<form    action="/validation/s1"  method="POST"> 
  <input type="text" placeholder="first name" name="f_name" ><br>
  <input type="text" placeholder="last name" name="l_name" ><br>
  <label id="birth">Date de naissance </label><input type="date" name="birth" ><br>
  <input type="email" placeholder="email"  name="email"><br>
  <input type="password" placeholder="password" autocomplete="off" name="password"><br>
  <input type="phone" placeholder="Phone" max="8" name="phone"><br>
  <select name="language">
    <datalist id="language">
        <option value="ar">العربية</option>
        <option value="fr">Français</option>
        <option vlaue='en'>English</option>
    </datalist><br>
  <input type="checkbox" name="chec_pass"><br>
  <button id='btn' type="submit">ok</button>
</form>
<script>
let check_pass=document.querySelector('input[type="checkbox"]');
let password=document.querySelector('input[type="password"]');
check_pass.addEventListener('change',function(){  
   this.checked===true ? 
   password.setAttribute('type',"text") :
   password.setAttribute('type',"password");
});/*
let formulaire=document.querySelector('#btn');
formulaire.addEventListener('submit',function(e){
 alert('fdgd');
  e.preventDefault();
}); */
</script>
</html>