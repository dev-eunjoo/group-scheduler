<?php
/* Eunjoo Na, 000811369
 * Date: 2020.12.08
 * Description: connect.php for the group scheduler web application. It connects to the database.
 */

try {
    $dbh = new PDO(
        "mysql:host=localhost;dbname=localdb",
        "",
        ""
    );
} catch (Exception $e) {
    die("ERROR: Couldn't connect. {$e->getMessage()}");
}
