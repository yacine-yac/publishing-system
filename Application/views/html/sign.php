<!Doctype html>
<html>
<form action="/validation/s1" method="POST"> 
  <input type="text" placeholder="first name" name="f_name" ><br>
  <input type="text" placeholder="last name" name="l_name" ><br>
  <label id="birth">Date de naissance </label><input type="date" name="birth" ><br>
  <input type="email" placeholder="email"  name="email"><br>
  <input type="password" placeholder="password" autocomplete="off" name="password"><br>
 
  <input type="checkbox" name="chec_pass"><br>
  <input type="submit">
</form>
<script>
let check_pass=document.querySelector('input[type="checkbox"]');
let password=document.querySelector('input[type="password"]');
check_pass.addEventListener('change',function(){  
   this.checked===true ? 
   password.setAttribute('type',"text") :
   password.setAttribute('type',"password");
});
</script>
</html>