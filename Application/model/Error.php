<?php
namespace model;
class Error{
    public function __construct($message=[]){
        echo "from error model".$message[0];
    }
}

?>