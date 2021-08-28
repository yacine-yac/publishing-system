<?php 
session_start();
//print(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH));
trait Call_loader{
  private function loader_call($path,$class,$param=NULL){ 
    $request=$path."\\".$class;
    if(file_exists("../Application/".$request.".php")){ 
       require "../Application/loader.php";
       $class=new $request($param);
    }else{
        require "../Application/model/Error.php";
        echo "<h1>this request can't get response</h1>";
    }
  }
}
class Rooting{
    private $cookie;
    private $class_obj;
    private $path_class;
    private $url;
    use Call_loader;
    public function __construct(){  
          $this->url=ucfirst(strtolower($_GET['url']));
          $path_url=explode('/',trim(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),'/'),3);
          print_r($path_url);
          print_r("+++".$this->url);
          echo "<br><br>";
          print_r($_GET);
          if(!isset($_COOKIE['client']) OR empty($_COOKIE['client'])){ echo "dddd";
            if(isset($_POST)  AND !empty($_POST)){
                 $this->post_rooting('controller/public/');
            }else{ 
                      $this->loader_call("controller","Login");
            }
            setcookie('client','021',time()+60*60*60);
            $_SESSION['client']="021";
          }else{
            if(isset($_SESSION['client']) AND $_SESSION['client']==$_COOKIE['client']){
                if(isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD']=="POST"){
                        $this->post_rooting('../controller/');
                    }elseif($_SERVER['REQUEST_METHOD']=="GET"){ 
                        $this->get_root();
                    }
            }else{  
                  $this->loader_call('controller','Login'); 
                   
                   /*require 'controller/public/Login.php';
                   $_POST['action']="off";
                   $class_app=new Login(); */
            }
          }   
    }
    private function get_root(){  
      if(isset($_GET['url']) AND !empty($_GET['url'])){  
            $url_controller=filter_var_array($_GET,FILTER_SANITIZE_URL);
            $url_controller=ucfirst(strtolower($url_controller['url']));
            echo "slimane";    
            $this->loader_call('controller',$this->url); 
      }else {  
         $this->loader_call('controller',"Home"); 
      }
    }
    private function post_rooting($path_class){
       if(isset($_POST['action'])){  
          $this->loading_class(); 
          $this->path_class=$_POST['action'];
          $class_obj=new $this->path_class(); 
        }
      }
}
$rooting=new Rooting();


?>
 <select list="poid">
 <datalist id="poid">
  <option value="22"> 
  <option value="222"> 
  <option value="232">
  <option value="2352">
  <option value="2323">
  <option value="20032">
  <option value="2320">
  <option value="2328">
  <option value="54232"> 
 </datalist>
</select>