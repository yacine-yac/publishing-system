<?php 
namespace controller\outside;
echo "<h1>controller\Login</h1>"; 
class Login{
  private $path=[];
  private $_sub_pat=[];
  private $data;
  const keys_post=[
           ["email","password","action","option"]
  ];
  const language=["EN","FR","AR"];
  const form=["f_name"=>FILTER_SANITIZE_SPECIAL_CHARS,
             'l_name'=>FILTER_SANITIZE_SPECIAL_CHARS,
             'birth'=>FILTER_VALIDATE_REGEXP,
             'email'=>FILTER_VALIDATE_EMAIL,
             "password"=>"dd"];
  public function __construct($path,$variables){ 
                $this->path=strtolower($path[0]);
                $this->sub_path=array_slice($path,1);
                $this->data=$variables;
              //  echo "sub_path"."sub_path"; 
                switch ($this->path) {
                  case "sign":
                       $this->validate();
                  break;
                  case "authentification":
                      $this->authentification();
                  break;
                  case "validation":
                      $this->validate();
                  break;
                  case "logout":
                     $this->loug_out();
                  break;
                  default:
                     $this->login();
                  break;
                }
   }
   private function login(){
    if(isset($_COOKIE['language']))$lang=$_COOKIE['language'];else$lang="EN";
    if(isset($_COOKIE['sub_id'])) $sub_id=$_COOKIE['sub_id'];else$sub_id=NULL;
        $obj=new \model\Login();
           
   }
private function authentification(){
       // print_r(array_values($_POST)[1]);
     //  print_r(array_filter(array_values($_POST),function($vl){return (empty($vl));}));
     // if(empty($f)){ echo "empty"; }else{ echo "no";}
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
private function validate($step="ff"){
    $_POST=["f_name"=>12,"l_name"=>"pp","birth"=>"novembre","email"=>"fdfdf","password"=>"555"];
    if(array_keys($_POST)==array_keys(Login::form)){
      var_dump(filter_list());
      echo print_r(array_values(Login::form))."oui";
      $array_data=array_filter($_POST,function($values,$key){
      if(empty($values)  OR !filter_var($values,array_values(Login::form)[$key])) return $key;},ARRAY_FILTER_USE_BOTH);
      
      if(empty($array_data)){
             /* foreach($_POST as $key=>$value){
                if(filter_var($key,FILTER_VALIDATE_INT)) 
                  echo "oui<br>"; 
                else{ echo $key;}
              }; */
             
      }else{ 
            echo "error,those variables make a problem";
            print_r($array_data);
      }
         
        //print_r(array_values($_POST));
    }else{
         echo "error";
    }       
}
private function loug_out(){ 
   session_destroy();
   setcookie('client',NULL,time()-36000);
   header('Location:home.php'); 
   $_POST=[];     
}
public function tell(){
  //echo "2021";
 // echo ($this->path);
 // print_r($this->path); 
} 
}


?>
