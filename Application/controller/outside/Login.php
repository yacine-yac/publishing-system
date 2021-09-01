<?php 
namespace controller\outside;  
echo "<h1>controller\Login</h1>";  
require_once(dirname(dirname(__DIR__)).'/configurations/config.Login.php');
class Login{
  private $path=[];
  private $_sub_pat=[];
  private $data;
  const keys_post=[
           ["email","password","action","option"]
  ];
  
  
  public function __construct($path,$variables){ 
                $this->path=strtolower($path[0]);
                $this->sub_path=array_slice($path,1);
                $this->data=$variables;

               // print_r($this->sub_path);
             // echo "sub_path"."sub_path"; 
                  switch($this->path){
                  case "sign":  
                      // print_r($this->validate($_POST,form)); 
                      // $obj=new \model\Login();
                     // $obj->build_interface();
                   $this->login('sign');
                  break;
                  case "authentification":  
                    // print_r($variables);
                   // print_r([0,1,2]);
                   // print_r([4,5,2]);
                  //  print_r(array_diff_key(["zkkkk"=>0,"zkk"=>1,"kz"=>6],["v"=>0,"zkk"=>1,"kz"=>6]));
                      //$_POST=['email'=>"","password"=>"edss"];$_POST
                      if(isset($_COOKIE['sub_id']) AND !empty($_COOKIE['sub_id'])){
                        $this->authentification(...$this->validate($variables,connect_sub)); 
                      }else{   
                        $this->authentification(...$this->validate($variables,connect));

                      }
                      // var_dump($this->validate($_POST,connect_sub));
                      
                  break;
                  case "validation":  
                     // $_POST=["f_name"=>"fddfd","l_name"=>"pp","birth"=>"2016-02-21","email"=>"ddd@ddsd.ss","password"=>"amla"];
                     // $this->validate($_POST);
                     $this->sign();
                  break;
                  case "logout":
                     $this->loug_out();
                  break;
                  default:
                     $this->login('login');
                  break;
                }
   }
   private function login($option){  
      /**
       * we should validate cookie sub_id
       * if isset sub_id we load model class and run function get name and picture user
       * if ! isset sub_id 
       */
      if(isset($_COOKIE['sub_id']) AND !empty($_COOKIE['sub_id'])){
            $obj= new \model\Login($_COOKIE['sub_id']);
            $response_login=$obj->sub_id();
            if($response_login[0]===true) $data=$response_login[1];
            else $data=null; 
      }
      else $data=null;
      $obj=new  \views\handler_views($option,$data);
   }
   private function sign(){  
          $response=$this->validate($this->data,sign_first);
          if($response[0]==true){
               if(in_array(strtolower(str_replace(',','',implode(",",$this->sub_path))),sign_step)){
                     $obj=new \model\Login($response[1]);
                     $obj->sign('s1');

               }
          }else{
            // new \model\Error();
          }
           
          //new \views\handler_views("sign");
   }
   private function authentification($state,$variables=[]){
   if($state===true){  
         if(isset($_COOKIE["sub_id"]) AND !isset($variables['email']) AND !empty($_COOKIE['sub_id'])){
               $variables["sub_id"]=$_COOKIE['sub_id'];                  
         }        
          $obj=new \model\Login($variables);
          if($obj->authentification()==true) return["type_response"=>"authentification","response"=>true];
          else return ["type_response"=>"authentification","response"=>false,"message"=>""];      
   }else{    print_r($variables);
             $obj=new \model\Error($variables);
   }
}
private function validate($inputs=[],$type_filters=[]){ 
    if(array_keys($inputs)==array_keys($type_filters)){
       $filters=$type_filters;   
      $array_data=array_filter($inputs,function($values,$key) use($filters){ 
                       if(empty($values) OR !filter_var($values,$filters[$key][0],$filters[$key][1]) ) return $key;},ARRAY_FILTER_USE_BOTH);
            if(empty($array_data)){     
                      return [true,$inputs]; 
            }else{  
                      return [false,$array_data];
            } 
    }else{  
                      return [false,array_diff(array_keys($type_filters),array_keys($inputs))];
    }       
}
private function loug_out(){ 
   session_destroy();
   setcookie('client',NULL,time()-36000);
   header('Location:home.php'); 
   $_POST=[];     
} 
}


?>
