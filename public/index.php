<?php 
namespace index;
session_start();

//print(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH));
require "../Application/loader.php";

class Rooting{
    private $cookie;
    private $class_obj;
    private $path_class;


    private $data;
    private $url=['path_class'];
    
    public function __construct(){  
         // $this->url=ucfirst(strtolower($_GET['url']));
         // $path_url=explode('/',trim(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),'/'),3);
         // print_r($path_url);
         // print_r("+++".$this->url);explode('/',str_replace('\\','/',$_GET['url']),3)
         
             //print_r($_GET);
            $url_variables=filter_var_array($_GET,FILTER_SANITIZE_URL);
            $this->url["path_class"]= preg_replace('/[^A-Za-z0-9\-]/','',explode("/",trim(str_replace('\\','/',parse_url($url_variables['url'],PHP_URL_PATH)),'/')));
            $this->data=array_slice($url_variables,1);
           // print_r(array_slice($url_variables,1));


           //print_r($url_variables);echo "<br><br>";
           //print_r(parse_url($url_variables['url']));echo "<br><br>";
           
          // print_r($this->url["path_class"]);
          // echo "<br><br>";
           //  = preg_replace('/[^A-Za-z0-9\-]/','',explode('/',trim(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),'/'),3));
           // print_r($this->url["path_class"]);
          if(!isset($_COOKIE['client']) OR empty($_COOKIE['client'])){ 
            if(isset($_POST)  AND !empty($_POST)){
                   $this->class_obj=new \model\Error();
            }else{
              if(!empty(implode(',',$this->url["path_class"]))){echo " not empty";
                 $this->class_obj=new \controller\outside\Login($this->url["path_class"],$this->data); 
                 $this->class_obj->tell();
              }else{ echo "empty";
                 $this->class_obj=new \controller\outside\Login(array("login"),$this->data);
              }
            }
         //setcookie('client','021',time()+60*60*60);
         //$_SESSION['client']="021";
          }else{ 
            if(isset($_SESSION['client']) AND $_SESSION['client']==$_COOKIE['client']){
                if(isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD']=="POST"){
                        $this->post_rooting('../controller/');
                    }elseif($_SERVER['REQUEST_METHOD']=="GET"){
                      if(!empty(implode(',',$this->url["path_class"]))){ 
                            $call= "\\controller\\inside\\".$this->url["path_class"][0];
                         if(class_exists($call,true)){
                               
                               $this->class_obj=new $call();
                         }else{ echo "no";
                          $this->class_obj=new \model\Error();
                         } 
                      }else{
                            $this->class_obj=new \controller\inside\Home();
                      }
                    }
            }else{ 
                      $this->class_obj=new \model\Error();
                      echo "not equale";
                 // $this->loader_call('controller','Login'); 
                   
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
           // $this->loader_call('controller',$this->url); 
             $calling=new \controller\inside\Home();
        }else{  
        // $this->loader_call('controller',"home");
        try{
          
        }catch(Exception $e){
            echo "error loading class";
        }
          
         //  $this->loader_call('controller',"convention\Home");
      }
    }
    private function post_rooting($path_class){
       if(isset($_POST['action'])){  
          $this->loading_class(); 
          $this->path_class=$_POST['action'];
         // $class_obj=new $this->path_class(); 
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