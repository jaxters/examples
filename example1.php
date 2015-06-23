<?php

$super_dynamic_array = array();

for($i = 0; $i< rand(20, 60); $i++){
	$super_dynamic_array[] = rand(10000, 100000);
}
$arrayDyn = $super_dynamic_array;
function array_split($array, $split) 
{   
    if ($split < 2) 
        return array($array);
    $newCount = ceil(count($array)/$split); 
    $a = array_slice($array, 0, $newCount); 
    $b = array_split(array_slice($array, $newCount), $split-1); 
    return array_merge(array($a),$b); 
} 
$splitedArr = array_split($arrayDyn, 3);
foreach($splitedArr as $arr){
            echo "<ul>";
    foreach ($arr as $row){
        echo "<li>".$row."</li>";
    }
     echo "</ul>";
}