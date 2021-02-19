<?php
/* Eunjoo Na, 000811369
 * Date: 2020.12.08
 * Description: getallschedule.php for the group scheduler web application. It connects to the database and select the data. Then it send the result as a json encoded array using schedule object.
 */

include "connect.php";
include "schedule.php";

$command = "SELECT id, `date` , title, `text`, username FROM schedule JOIN member  ON schedule.userid = member.userid ORDER BY `date` ASC";
$stmt = $dbh->prepare($command);
$success = $stmt->execute();

$list = [];
while ($row = $stmt->fetch()) {
    $schedule = new Schedule($row["id"], $row["date"], $row["title"], $row["text"], $row["username"]);
    array_push($list, $schedule);
}

echo json_encode($list);
