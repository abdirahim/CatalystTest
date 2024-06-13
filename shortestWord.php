<?php
$string = file_get_contents('./input.txt', true);
$word = "";
$words = array();

$string = $string . " ";

for($i = 0; $i < strlen($string); $i++){
    //Split the string into words
    if($string[$i] != ' '){
        $word = $word . $string[$i];
    }
    else{
        //Add word to string array words
        array_push($words, $word);
        //Make word an empty string
        $word = "";
    }
}

$small = $words[0];

//Determine smallest
for($k = 0; $k < count($words); $k++){
    if(strlen($small) > strlen($words[$k]))
        $small = $words[$k];

}

print("Smallest word: " . $small);


