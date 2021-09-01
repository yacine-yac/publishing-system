<?php 
namespace model; 
require_once "Bdd.php";
class Login extends Bdd{
    private $data;
    public function __construct($data){
        $this->data=$data;
    }
    public function authentification(){
       $result= $this->prepare_request($this->data,["id","sub_id","lang"]); 
       if($result['state']===true){
            $this->count('',''); /**send ids to count after generate it */      
            return true;
       }else{
            return false;
       }
    }
    private function count(string $id,string $sub_id){
                   setcookie('client',$id,time()+60*180*60);
                   $_SESSION['client']=$id;
                   setcookie('sub_id',$sub_id,time()+60*180*60);
                   setcookie('lang',$sub_id,time()+60*180*60);
    }
    public function sign(string $step){print_r($this->data);
      if(in_array($step,sign_step)){
           $result= $this->prepare_request($this->data);
           if($result[0]===true){
                $this->generat_ids();
                $this->count();
                return true;
           }else{

           }
       }
          /** if stpe 1 finish we generate ids function => count function  */
    }
    private function generat_ids(){
           /*  generat id and sub_id */
           return ['id'=>'yacine',"sub_id"=>"malki"];
    }
    public function sub_id(){
        if(!empty($this->data)){
            $result= $this->prepare_request($this->data,["id","picture"]);
             /** we should check if data is retourned */  // print_r($this->data);
            return [true,["id"=>"ds","picture"=>"eeee.png"]];
        }else{
            return [false];
        }
    }
}
?>