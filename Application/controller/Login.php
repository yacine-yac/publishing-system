<?php 
namespace controller;
echo "<h1>controller\login</h1>";


class Login{
   private $get_class;
   private $obj;
 //  use loader_class;
   const keys_post=[
           ["email","password","action","option"]
   ];
   public function __construct(){  echo "5555";
        $this->get_class=spl_autoload_register(function($class){
                require "../model/".$class.".php";
        });
        if(isset($_POST['option']) AND !empty($_POST['option'])){
           if($_POST['option']=='on'){
               $this->authentification();      
             }else{
                 $this->loug_out();
             }      
        }else{ echo "<br>7878<br>";
             //  require 'public/login.php';
        }
}
private function authentification(){
       // print_r(array_values($_POST)[1]);
     //  print_r(array_filter(array_values($_POST),function($vl){return (empty($vl));}));
     // if(empty($f)){ echo "empty"; }else{ echo "no"; }
       if(in_array(array_keys($_POST),self::keys_post) AND empty(array_filter(array_values($_POST),function($vl){return (empty($vl));}))){
             setcookie('client',"dsdsd",time()+36000);
             $_SESSION['client']="dsdsd";
             $_POST=[];  
        }else{ 
          if(file_exists("../model/".$_POST['action'].".php")){
                  echo "ddd";
                  $_POST['action']="Login";
                  $this->loading_class();
                //  $k=new $_POST['action']();   
             // $this->obj=new $_POST['action']();     
          }
            
        }
       
}
private function loug_out(){
   echo "déconnexion";
   session_destroy();
   setcookie('client',NULL,time()-36000);
   require 'login.php';
   $_POST=[];     
} 
}


?>
