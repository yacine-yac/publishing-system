<?php 
namespace model;
require "handler_views.php";
class Login extends handler_views{
    public function __construct(){
        $this->fach();
        echo "model/ login";
    }
}
?>