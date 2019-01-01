<?php

function get_rank($uuid) {

    require 'database/rank-database.php';

    $ugly = $uuid;

    $pos = strpos($ugly, '-');

    if($pos === false) {
        $ugly = ugly_uuid($ugly);
    }
 
    $query = "SELECT * FROM players WHERE uuid='$ugly'";
    $result = mysqli_query($connection, $query);

    $rows = mysqli_num_rows($result);

    if($rows < 1) {
        exit();
    }

    $info = mysqli_fetch_assoc($result);

    $value = $info['rank'];

    $connection->close();

    return $value;

}

function is_blacklisted($uuid) {

    require 'database/rank-database.php';

    $ugly = $uuid;

    $pos = strpos($ugly, '-');

    if($pos === false) {
        $ugly = ugly_uuid($ugly);
    }

    $query = "SELECT * FROM players WHERE uuid='$ugly'";
    $result = mysqli_query($connection, $query);

    $rows = mysqli_num_rows($result);

    if($rows < 1) {
        exit();
    }

    $info = mysqli_fetch_assoc($result);

    $value = $info['blacklisted'];

    $connection->close();

    if($value == 1) {
        return true;
    }

    return false;

}

function get_name_by_id($playerId) {

    require 'database/rank-database.php';

    $query = "SELECT name FROM players WHERE player_id='$playerId'";
    $result = mysqli_query($connection, $query);

    $rows = mysqli_num_rows($result);

    if($rows < 1) {
        
        $delete_query = "DELETE FROM practice_season_4_data WHERE player_id='$playerId'";
   
        if (mysqli_query($connection, $delete_query)) {
            echo "Deleted " . $playerId . " from the records";
            exit();
        }
    }

    $info = mysqli_fetch_assoc($result);

    $value = $info['name'];

    $connection->close();
    
    return $value;
}

function get_id_by_name($playerName) {

    require 'database/rank-database.php';

    $query = "SELECT player_id FROM players WHERE name='$playerName'";
    $result = mysqli_query($connection, $query);

    $rows = mysqli_num_rows($result);

    if($rows < 1) {
        
        $delete_query = "DELETE FROM practice_season_4_data WHERE name='$playerName'";
   
        if (mysqli_query($connection, $delete_query)) {
            echo "Deleted " . $playerName . " from the records";
            exit();
        }
    }

    $info = mysqli_fetch_assoc($result);

    $value = $info['player_id'];

    $connection->close();
    
    return $value;
}

function is_banned($uuid) {

    require 'database/rank-database.php';

    $ugly = $uuid;

    $pos = strpos($ugly, '-');

    if($pos === false) {
        $ugly = ugly_uuid($ugly);
    }

    $query = "SELECT * FROM players WHERE uuid='$ugly'";
    $result = mysqli_query($connection, $query);

    $rows = mysqli_num_rows($result);

    if($rows < 1) {
        exit();
    }

    $info = mysqli_fetch_assoc($result);

    $value = $info['banned'];

    $connection->close();

    if($value === 1) {
        return true;
    }

    return false;

}

function has_modify_permission($uuid) {

    $clean_uuid = str_replace("-", "", $uuid);

    $rank = get_rank($clean_uuid);

    if($rank === "Owner" || $rank === "Developer" || $rank === "Platform-Admin" || $rank === "Senior-Admin" || $rank === "Admin" || $rank === "Senior-Mod") {
        return true;
    }

    return false;

}

function has_view_permission($uuid) {

    $clean_uuid = str_replace("-", "", $uuid);

    $rank = get_rank($clean_uuid);

    if($rank === "Owner" || $rank === "Developer" || $rank === "Platform-Admin" || $rank === "Senior-Admin" || $rank === "Admin" || $rank === "Senior-Mod" || $rank === "Mod" || $rank === "Trainee") {
        return true;
    }

    return false;

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

                $user = str_replace("@", "", $word);
                $text = str_replace($word, "<a href='user.php?name=$user'>$word</a>", $text);
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

function pending_tickets($uuid) {

    require 'database/support-database.php';

    $query = "SELECT * FROM ticket WHERE (resolved = -1 AND uuid = '$uuid')";

    $result = mysqli_query($connection, $query);

    $rows = mysqli_num_rows($result);

    if($rows < 1) {
        return 0;
    } 

    return $result;

}
