<?php

function get_rank($uuid) {

    include 'database/rank-database.php';

    $ugly = ugly_uuid($uuid);

    $query = "SELECT * FROM players WHERE uuid='$ugly'";
    $result = mysqli_query($connection, $query);
    $rows = mysqli_num_rows($result);

    if($rows < 1) {
        exit();
    }

    $info = mysqli_fetch_assoc($result);

    return $info['rank'];

}


function logged_in() {
    if(isset($_SESSION['status'])) {
        if($_SESSION['status'] == 1) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }

    return false;
}
 
function get_name($uuid) {

    if(array_key_exists($uuid, $_SESSION['usernames'])) {
        return $_SESSION['usernames'][$uuid];
    }
    
    $clean_uuid = str_replace("-", "", $uuid);

    $json_response = file_get_contents('https://api.minetools.eu/uuid/' . $clean_uuid);

    $obj = json_decode($json_response);

    $_SESSION['usernames'][$uuid] = $obj->name; 
    
    return $obj->name;
}

function get_uuid($name) {

    if(array_key_exists($name, $_SESSION['cache_uuid'])) {
        return $_SESSION['cache_uuid'][$name];
    }

    $json_response = file_get_contents('https://api.minetools.eu/uuid/' . $name);

    $obj = json_decode($json_response);

    $_SESSION['cache_uuid'][$name] = $obj->id; 
    
    return $obj->id;
}

function ugly_uuid($string) {
    
    $string = substr_replace($string, "-", 8, 0);

    $string = substr_replace($string, "-", 13, 0);

    $string = substr_replace($string, "-", 18, 0);

    $string = substr_replace($string, "-", 23, 0);

    return $string;
}

function check_tag($text) {

    $words = explode(" ", $text);

    foreach($words as $word) {

        $pos = strpos($word, '@');

        if($pos !== false) {

            if($pos === 0) {
                $text = str_replace($word, "<a href='#'>$word</a>", $text);
            }
        }
    }

    return $text;

}

function get_resolved($resolved) {
        
    if($resolved == 0) {
        return "Denied";
    } elseif($resolved == 1) {
        return "Accepted";
    }
    
    return "Pending";
    
}