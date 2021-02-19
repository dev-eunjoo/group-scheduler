<?php
/* Eunjoo Na, 000811369
 * Date: 2020.12.08
 * Description: addschedule.php for the group scheduler web application. It connects to the database and insert the data.
 */

include "connect.php";

$title = filter_input(INPUT_GET, "titleparam", FILTER_SANITIZE_SPECIAL_CHARS);
$text = filter_input(INPUT_GET, "textparam", FILTER_SANITIZE_SPECIAL_CHARS);
$date = filter_input(INPUT_GET, "dateparam", FILTER_SANITIZE_SPECIAL_CHARS);
$userid = filter_input(INPUT_GET, "idparam", FILTER_VALIDATE_INT);


$command = "INSERT INTO schedule ( title, `text`, `date`, `userid`) VALUES (?,?,?,?)";
$stmt = $dbh->prepare($command);
$params = [$title, $text, $date, $userid];
$success = $stmt->execute($params);

if ($success) {
    echo "success";
} else {
    echo "Fail";
}
