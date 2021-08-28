<!Doctype html>
<html>
<form method="POST">
  <input type="email" placeholder="email"  name="email"><br>
  <input type="password" placeholder="password" autocomplete="off" name="password"><br>
  <input type="text" placeholder="text" name="action" ><br>
  <input type="text" placeholder="text" name="option" ><br>
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