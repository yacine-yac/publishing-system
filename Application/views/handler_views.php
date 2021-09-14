<?php
namespace views;  
//require_once dirname(__DIR__)."/configurations/config.language.php";
class handler_views{
    private $language;
    public function __construct($template,$data=[]){  if(isset($data))echo "from handelr".print_r($data);
        $this->language= isset($_COOKIE['language']) AND in_array($_COOKIE['language'],\configurations\Language::languages) ? $_COOKIE['language']: "EN";
     // print_r($this->language);
      if(file_exists(__DIR__."/html/$template.php")) 
          require_once __DIR__."/html/$template.php";
      else $this->error_views() ;
           
    }
    private function language(){
      
    }
    private function error_views(){
         
    }
}
?>