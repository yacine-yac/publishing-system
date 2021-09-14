<?php 
namespace model;
use PDO;
require_once dirname(__DIR__).'/configurations/Bdd.php';
class Bdd{
    private static $generator=generator;
    private static $host=host;
    private static $db=dbname;
    private static $root_bdd=root;
    private static $password_db=password;
    private static $connect; 
    private static $options_connect=array(PDO:: MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8");
 
    private static function connect_bdd(){   
        try{ 
            self::$connect=new PDO(self::$generator.":host=".self::$host.";dbname=".self::$db,self::$root_bdd,self::$password_db,self::$options_connect);
            self::$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(\PDOException $e){ 
              echo "data base error";
              $e->getMessage();
              self::__dustruct();
              return [false]; 
             //  new Error($e->message);
        }
    } 
    public static function prepare_request(string $request,$data=[]){  
        self::connect_bdd();
        $message=NULL;
        $count=0;
     if(self::$connect){ 
        try{
                  $query=self::$connect->prepare($request);
                     /** we should checked characters of inputs regExp() */
                    /* foreach($data as $key=>$value){
                      $query->bindParam($key+1,$value);
                       echo  "<br>".($key+1).">>>>>>>>>>".$value;
                    }*/
                    // echo "<br> >>>>>>>>>>>>";
                 // print_r($request); echo "|||||||||<br>";
                  $f=$query->execute($data);
                 
                  $count=$query->rowCount();  echo "bddddd".$count;
                  $message=$query->fetch();
                  $action=true;
        }catch(\PDOException $excep){
            echo "error query".$excep->getPrevious()."<br>";
            echo "<br>".print_r($excep->errorInfo[2])."<br>";
            $message=["state"=>$excep->getCode(),"message"=>$excep->getMessage()];
        }
    }else{ 
                self::__dustruct();
    }
             // $this->call=$type_request;
                
       /** some traitmenets for prepare response */
                $action= $count>0 ?  true :  false ;
                return [$action,$message];



        /** 
         * prepare all request to database 
         *  select * from table WHERE CONDITION OFFSET LIMIT or group by ....
         *  update table set column =value 
         * DELET from table where column =value
         * insert into table(columns) values(????) 
         */
    }
    /*private function handl_options($type,$variables,$operator){
            $condition=" ";
            foreach($type as $cle=>$var){
                    $param="";
                    foreach($variables as $column=>$value){ $param .=$column."=".$value." ".$operator; }
                    $condition .=$var." ".$param;
            }
            return $condition;
    }
    protected function prepare_request($requests=[],$data=[],$tables="",$options=[]){
       $options= [
            [ 
                 'type'=>["WHERE"],
                 "variables"=>[[["id",55],["name","yacine"]],[]],
                 "operator"=>["AND"]
            ]
 
        ];
            $CRUD=[
               "select"=> "SELECT {implode(',',array_keys($data))} FROM $tables $condition",
               "update"=> "UPDATE $tables SET column= value AND column=VALUE WHERE condition",
               "delete"=> "DELETE FROM $tables WHERE {...$data} ",
               "insert"=> "INSERT INTO $tables({...array_keys($data)}) VALUES({...array_values($data)})"
            ];
            foreach($requests as $key=>$type_request){
               
               $this->request.="$type_request  ;";
               $this->handl_options($options['type'],$options['variables'],$options['operator']);
            }
        
       $this->connect->prepare(self::$sql_request);
       return ["state"=>false];
    }
    */
    private static function __dustruct(){
        self::$connect=NULL;
        echo "destruct";
    }
}

?>