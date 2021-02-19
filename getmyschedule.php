<?php
/* Eunjoo Na, 000811369
 * Date: 2020.12.08
 * Description: getmyschedule.php for the group scheduler web application. It connects to the database and select the data. Then it send the result as a json encoded array.
 */

include "connect.php";

$userNumber = filter_input(INPUT_GET, "useridparam", FILTER_VALIDATE_INT);

$command = "SELECT id, `date` , title, `text` FROM schedule WHERE userid = ? ORDER BY `date` ASC";
$stmt = $dbh->prepare($command);
$params = [$userNumber];
$success = $stmt->execute($params);

$list = [];
while ($row = $stmt->fetch()) {
    $schedule = [
        "id" => $row["id"],
        "date" => $row["date"],
        "title" => $row["title"],
        "text" => $row["text"]
    ];
    array_push($list, $schedule);
}

echo json_encode($list);
