<?php
const filters_dictenory=[     
    "alphabets"=>[FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^\pL+$/u"))],
    "date"=>[FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/\d{4}\-\d{2}-\d{2}/"))],
    "email"=>[FILTER_VALIDATE_EMAIL,NULL]
];
const sign_first=[
     "f_name"=>filters_dictenory["alphabets"],
     'l_name'=>filters_dictenory["alphabets"],
     'birth'=>filters_dictenory["date"],
     'email'=>filters_dictenory["email"],
     "password"=>filters_dictenory["alphabets"]
    ];
const connect=[
        "email"=>filters_dictenory['email'],
        "password"=>filters_dictenory["alphabets"]
      ];
const connect_sub=[
       "password"=>filters_dictenory["alphabets"]
      ];
const sign_step=['s1','s2',"s3"];
?>