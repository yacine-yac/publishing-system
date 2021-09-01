<?php
//namespace App\loader;
define('DS',DIRECTORY_SEPARATOR );
define('project',dirname(__DIR__).DS);
define('app',project."Application".DS);
define('config',app."configuration".DS);
define('model',app."model".DS);
define('views',app."views".DS);
define('controller',app."controller".DS);
$modules=[project,app,model,views,controller];
set_include_path(get_include_path(). PATH_SEPARATOR .implode(PATH_SEPARATOR,$modules));

spl_autoload_register('spl_autoload');
//define('path_project',dirname(__FILE__));
 
//echo path_project;
//echo "<br>".__NAMESPACE__."<br>";
/*
class Load{
    private static $path_class;
    public static function loader_call($class_get){
         self::$path_class= path_project."/".$class_get.".php";
            if(file_exists(self::$path_class)){
                try{  
                  self::$path_class=str_replace("\\",'/',self::$path_class);
                   // self::$path_class=  str_replace("\\", DIRECTORY_SEPARATOR,self::$path_class);
                  require self::$path_class ; 
                }catch(Exception $e){
                   require "model/Error.php";
                }
            }
    }
}
spl_autoload_register(__NAMESPACE__."\Load::loader_call");
*/

?>