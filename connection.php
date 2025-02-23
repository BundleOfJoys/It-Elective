<?php


$db = new mysqli("localhost", "root", "", "onepiece");


if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>
