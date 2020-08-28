<?php

// Read Providers From Json Files

function readJsonFile($name,$key){
    $path = storage_path() . "/jsonfiles/".$name.".json";
    $json = json_decode(file_get_contents($path), true);
    for ($i=0; $i < count($json[$key]); $i++) { 
        $json[$key][$i]['provider'] = $name;
    }
    return $json[$key];
}
