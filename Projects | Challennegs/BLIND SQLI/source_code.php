<?php

function dbconnect() {
        $db = new mysqli('localhost', 'root', '', 'sqli_challenge');
        if ($db->connect_error) {
                die("connection failed: ".$db->connect_error);
        }
        return $db;
}

$db = dbconnect();

echo "<!DOCTYPE html>
<html lang='en'>
<head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>SQLi Challenge</title>
</head>
<body>
        <h1>SQL INJECTION CHALLENGE</h1>
        <div>
                <p><strong>DISALLOWED CHARACTERS:</strong> the following characters are not allowed: <strong>_ .( )</strong></p>
                <p><strong>DISALLOWED KEYWORDS:</strong> the following keywords are not allowed: <strong>or, and, substring</strong></p>
                <p><strong>ONE MORE CONDITION</strong>: the query is only able to take the url encoding in it so use the url encodings of the charcters like: & => %26, = => %3Dand so on...(you can can ge>
                <p><strong>TO COMPLETE:</strong> BYPASS THE LOGIN AS THE <strong>admin by getting it's password</strong> user</p>
        </div>";

if (isset($_GET['pw'])) {
        if (preg_match('/_|\.|\(\)/i', $_GET['pw'])) {
                exit("NO HACK ~_~");
        }
        if (preg_match('/or|and|substring/i', $_GET['pw'])) {
                exit("HEHE");
        }

        $query = "select * from users where id='guest' and pw='{$_GET['pw']}'";
        echo "<hr>query : <strong>{$query}</strong><hr><br>";
        $result = @mysqli_fetch_array(mysqli_query($db,$query));

        if ($result['id']) {
                echo "<h2>Hello {$result['id']}</h2>";
        }

        $query = "select * from users where id='admin' and pw='{$_GET['pw']}'";
        $result = @mysqli_fetch_array(mysqli_query($db, $query));

        if (($result['pw']) && ($result['pw'] == $_GET['pw']))   {
                echo "<h2>CHALLENGE CLEARED!! Hello admin !!</h2>";
        }

} else {
        echo "<h2>required password to clear this level</h2>";
}

?>
