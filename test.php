<?php
  
// $date = '2019-01-15 12:01:12';
// $date1 = '2019-01-19 12:07:12';

// function dateDifference($date_1 , $date_2 , $differenceFormat = '%d Day %h Hours' )
// {
//     $datetime1 = date_create($date_1);
//     $datetime2 = date_create($date_2);
    
//     $interval = date_diff($datetime1, $datetime2);
    
//     return $interval->format($differenceFormat);
    
// }

// // echo dateDifference($date, $date1);
// echo date("M jS, Y",strtotime($date));

//https://api.mojang.com/user/profiles/05cc5c6a48534abfa4c807372696dc0f/names

$json_response = file_get_contents('https://api.mojang.com/user/profiles/05cc5c6a48534abfa4c807372696dc0f/names');

$obj = json_decode($json_response);

$size = sizeof($obj);

for ($i = 0; $i < $size; $i++) {
    echo $i . " ".  $obj[$i]->name . "<br>";
}