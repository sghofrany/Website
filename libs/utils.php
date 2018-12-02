<?php
// session_start();


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

    return "Name";
    
    if(array_key_exists($uuid, $_SESSION['usernames'])) {
        return $_SESSION['usernames'][$uuid];
    }
    
    
    $clean_uuid = str_replace("-", "", $uuid);

    $json_response = file_get_contents('https://api.minetools.eu/uuid/' . $clean_uuid);

    $obj = json_decode($json_response);

    $_SESSION['usernames'][$uuid] = $obj->name; 
    
    return $obj->name;
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