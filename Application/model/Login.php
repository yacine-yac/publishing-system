<?php 

namespace model;  
//require_once "Bdd.php";
//print_r(dirname(\configurations\config.language));
//require_once dirname(__DIR__)."\configurations\config.language.php"; 
//print_r(\configurations\Language::log); 

class Login{
    private $data;
    use Time; 
    public function __construct($data){  
        $this->data=$data;   
    }
    public function authentification($auth="email"){ 
        /** function get if work with sub_id or email */
        $result= \model\Bdd::prepare_request("SELECT id,sub_id,password,language FROM users WHERE  ".$auth."=? ",[$this->data[$auth]]); 
        if($result[0]===true){ 
           if($result[1]['password']===$this->data['password']){
               $this->account($result[1]['id'],$result[1]['sub_id']);
               /**send ids to count after generate it loading page  */ 
               echo "i am here";     
               return ["state"=>true];    
           }else{
            echo "hello mr i don't remember your name password incorrect";
                 /** password not correct */
                 return ["state"=>false,["msg"=>"password incorrect"]];
            } 
        }else{ echo "hello user not founded";
            /**problem user */
            return ["state"=>false,["msg"=>"user not founded"]];
        }
        /**we should get variable who made the 
                         * problem email sub_id (user not identified)
                         * error password with name profil
                         * not reload page return view directly
        */
    }
    private function account(string $id,string $sub_id,$lang="EN"){
                    setcookie('client',$id,time()+60*180*60,'/');
                    $_SESSION['client']=$id;
                    setcookie('sub_id',$sub_id,time()+60*180*60,'/');
                    setcookie('lang',$lang,time()+60*180*60,'/');
                    echo "||||||||||||||||||||".$_SESSION['client']."||||||||||||||||||||";
    }  
    public function sign(string $step){ 
        if(in_array($step,array_keys(\configurations\sign::sign_step))){ 
         $action_step=$this->$step(); 
         if($action_step[0]===true){//echo "<br>"; print_r($action_step['columns']);echo "<br>";echo "<br>"; print_r($this->data);echo "<br>";
            $result=\model\Bdd::prepare_request("INSERT INTO ".$action_step['columns']." ".$action_step['values'],array_values($this->data));
            if($result[0]===true){ 
              // print_r($this->data['id']);
               // $this->account($this->data['id'],$this->data['sub_id']);
                   $action_step['fu']();
                  echo "element created >>>>>>>>>";
                return[
                    "state"=>true, 
                    'action'=>""
                ]; 
            }else if($result[0]===false){ //print_r($result);
                if($result[1]['state']==="23000" AND preg_match("/'PRIMARY'\\b/",$result[1]['message'])===1){
                      echo    ">>>fsdfdsfdf>";
                       $this->sign($step);
                 }else{
                   //  print_r($result);
                     echo "<br>element not created";
                     /** reg expression for return column who have problem like email and phone */
                     return false;
                 }

            }
         }else{ echo 5555555;
             /** return error somthin not  */
         }  
        }
          /** if stpe 1 finish we generate ids function => count function  */
    }
    private function s1(){ 
        $this->data['id']=$this->generat_ids(NULL,0,36);
        $this->data['sub_id']=$this->generat_ids("user_",1,18);
        $this->data['date_register']=date("Y-m-d h:i:s");   
        if(in_array(strtoupper($this->data['language']),\configurations\Language::languages)){
            if($this->date_difference($this->data['birth'],date('Y-m-d')," %y ")>=9){
             // 
             $columns=\configurations\sign::sign_step["s1"];
            return [ 
                true,
                "columns"=>'users('.implode(',',$columns).')',
                "values"=>"VALUES(".implode(',',array_map(function(){return "?";},$columns)).")"
                 ,"fu"=>function(){
                     $this->account($this->data['id'],$this->data['sub_id']);
                     return "yacino ess";
                                   }
                ] ;
              //  end();
        }else{ return [false,"plateform don't accept children hhhhhhhh "] ; }
            /** check phone contry after and password  */
        }else{return[false,"this language not belonges to our plateform"];}
    }
    private function s2(){}
    private function s3(){} 
    private function generat_ids($prefix="",$serial=0,$length=36){
           /*  generat id and sub_id */
            $id=$prefix."";
            $string=[
               "012WXYZabcd34efgMNOhijkABC89DEFlmnop567qrGHIJKtsQRSvwxyzLPTV",
               "efgMNOhijkABCss89D5452636EFlfkdmnop567qr"]; 
            for($i=0;$i<$length;$i++){
                 $id.=$string[$serial][mt_rand(0,strlen($string[$serial])-1)];
            } 
             return $id; 
    }
    public function sub_id(){
        if(!empty($this->data)){ echo "<br>";
          // print_r($this->data);
            $result= \model\Bdd::prepare_request("SELECT picture,l_name,f_name FROM users WHERE sub_id=?",[$this->data]);
             /** we should check if data is retourned */  // print_r($this->data);
          if($result[0]===true) return $result;
          else return [false];
        }else{
            return [false];
        }
    }
}
?>