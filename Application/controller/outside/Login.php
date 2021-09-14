<?php 
namespace controller\outside;  
echo "<h1>controller\Login</h1>";  
require_once(dirname(dirname(__DIR__)).'/configurations/Login.php');
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
                   /** check acces with sub_id or email&password */
                  if(isset($_COOKIE['sub_id']) AND empty($_COOKIE['sub_id'])===false){ 
                     $auth="sub_id";
                     $this->data['sub_id']=$_COOKIE['sub_id'];
                     $parameter=connect_sub;
                  }else{
                    $auth="email"; $parameter=connect;
                  }  
                  $this->authentification($parameter,$auth);
                  break;
                  case "validation":  
                     // $_POST=["f_name"=>"fddfd","l_name"=>"pp","birth"=>"2016-02-21","email"=>"ddd@ddsd.ss","password"=>"amla"];
                     // $this->validate($_POST);
                     echo "siiiiiiiiiiiiiiiiiiiiiiiiiiign";
                      $this->sign();
                  break;
                  case "logout": echo ">>>>>>>>>>>>>>>>>>>>>>>>>>>>><ee8888888888";
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
      
      /** send data to handle view and if 
               *   state=true         
                           *  have name and picture we return template with password input 
                           *  don't have sub_id   return login with password and email inputs
               * state=false
                           *  don't have sub_id   return login with password and email inputs
       */
    //  echo "Mr ".$data["l_name"]." ".$data["f_name"]."  Please write your password";
     // print_r(array_keys($data));
      $obj=new  \views\handler_views($option,$data);
   }
   private function sign(){         
         define("type_sign",["s1"=>sign_first,"s2"=>sign_second,"s3"=>sign_third]);
         if(in_array($this->sub_path[0],array_keys(type_sign))){ 
          $response=$this->validate($this->data,type_sign[$this->sub_path[0]]);
          
          // print_r(strtolower(str_replace(',','',implode(",",$this->sub_path))));
          if($response[0]==true){  
               if(in_array(strtolower(str_replace(',','',implode(",",$this->sub_path))) ,array_keys(\configurations\sign::sign_step))){
                     $login=new \model\Login($response[1]);
                     $setting_view=$login->sign($this->sub_path[0]);
                     print_r($setting_view);
                    // $setting_view['state']=true;
                     if($setting_view['state']===true){
                         /** run function  */
                         echo "action >>>>>>>>>>>>>>>>>>>>>>";
                         header('Location:/setting/s2');
                     }else{

                     }   
                     /** state ==true 
                                  *  made loading after s1 -> header
                                  * async in s2 and s3 with settings/s step 2 or 3 ->views  
                      * state ===flase
                                 * action to error 
                                 *in s1 returning with response ajax ['name'=> error message];
                                 * in setting   
                      */
            }  
          }else{ echo "error validate parameters".print_r($response); 
            // new \model\Error();
          } 
         }else{   echo "error configurations";
             /** error from url path s1,s2,s3 */
          }    
          //new \views\handler_views("sign");
   }
   private function authentification(array $type_filters,$auth="email"){ 
      
      $response=$this->validate($this->data,$type_filters);echo "sdfdffd";
      if($response[0]===true){  
          $obj=new \model\Login($this->data);
          $result=$obj->authentification($auth);
          if($result['state']===true){
            //return["type_response"=>"authentification","response"=>true];
            header('Location:/home');
            var_dump($_SERVER);
          }else{ 
            return ["type_response"=>"authentification","response"=>false,"message"=>""];
          }     
      }else{   
            echo "error parameters filters"; 
            print_r($response);
         //   $obj=new \model\Error($this->data);
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
    }else if(array_keys($inputs)<array_keys($type_filters)){
               return [false,array_diff(array_keys($type_filters),array_keys($inputs))];
    }else{
               return [false,array_diff(array_keys($inputs),array_keys($type_filters))];
    }
}
}
