<?php
const filters_dictenory=[     
    "alphabets"=>[FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^\pL+$/u"))],
    "alphanumeric"=>[FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^[a-zA-Z]+[a-zA-Z0-9._]+$/"))],
    "date"=>[FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/\d{4}\-\d{2}-\d{2}/"))],
    "email"=>[FILTER_VALIDATE_EMAIL,NULL],
    "phone"=>[FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^[0-9]{9}$/"))]
];
const sign_first=[
     "f_name"=>filters_dictenory["alphabets"],
     'l_name'=>filters_dictenory["alphabets"],
     'birth'=>filters_dictenory["date"],
     'email'=>filters_dictenory["email"],
     "password"=>filters_dictenory["alphabets"],
     "phone"=>filters_dictenory['phone'],
     "language"=>filters_dictenory['alphabets']
    ];
const sign_second=[];
const sign_third=[];
const connect=[
        "email"=>filters_dictenory['email'],
        "password"=>filters_dictenory["alphabets"]
      ];
const connect_sub=[
       "password"=>filters_dictenory["alphabets"],
       "sub_id"=>filters_dictenory['alphanumeric']
      ];



 
?>