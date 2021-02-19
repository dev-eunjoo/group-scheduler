<?php
/* Eunjoo Na, 000811369
 * Date: 2020.12.08
 * Description: deleteschedule.php for the group scheduler web application. It connects to the database and delete the data.
 */

include "connect.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

$command = "DELETE FROM schedule WHERE id = ?";
$stmt = $dbh->prepare($command);
$params = [$id];
$success = $stmt->execute($params);

if ($success) {
    echo "success";
} else {
    echo "Fail";
}
