<?php
namespace App\loader;
define('path_project',dirname(__FILE__));
//echo path_project;
//echo "<br>".__NAMESPACE__."<br>";
class Load{
    private static $path_class;
    public static function loading($class_get){
          self::$path_class= path_project."/".$class_get.".php";
            if(file_exists(self::$path_class)){
                try{
                   require self::$path_class ; 
                }catch(Exception $e){
                   require "model/Error.php";
                }
            }
    }
}
spl_autoload_register(__NAMESPACE__."\Load::loading");

?>