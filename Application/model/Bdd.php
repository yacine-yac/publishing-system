<?php 
namespace model;
require_once dirname(__DIR__).'/configurations/config.Bdd.php';
class Bdd{
    private $connect;
    public function __construct(){
        try{
           $this->connect=new \PDO(generator.":host=".host.";dbname=".dbname,root,password);
        }catch(Excepetion $e){
               new Error($e->message);
        }
    }
    protected function prepare_request($data){
       return ["state"=>false];
    }
}

?>