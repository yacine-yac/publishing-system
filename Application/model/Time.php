<?php 
namespace model;
trait Time{
    public function date_difference(string $first,string $second,$format="Y%"){ 
        /** check if argument data form ?? before calculate */ 
        $date1=date_create($first);
        $date2=date_create($second);
        $diff=date_diff($date1,$date2);
       return $interval=$diff->format($format);
    }
}
?>
