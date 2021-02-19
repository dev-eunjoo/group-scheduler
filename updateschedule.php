<?php
/* Eunjoo Na, 000811369
 * Date: 2020.12.08
 * Description: updateitem.php for the group scheduler web application. It connects to the database and update the data.
 */

include "connect.php";

$title = filter_input(INPUT_GET, "title", FILTER_SANITIZE_SPECIAL_CHARS);
$text = filter_input(INPUT_GET, "text", FILTER_SANITIZE_SPECIAL_CHARS);
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

$command = "UPDATE schedule SET title = ?, `text` = ?  WHERE id = ?";
$stmt = $dbh->prepare($command);
$params = [$title, $text, $id];
$success = $stmt->execute($params);

if ($success) {
    echo "success";
} else {
    echo "Fail";
}
