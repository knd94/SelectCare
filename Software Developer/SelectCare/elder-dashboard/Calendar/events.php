<?php
include('dbcon.php');
$query = $conn->query("SELECT * FROM events ORDER BY id");
$events = array();
while ($row = $query->fetch_object()) {
    $events[] = array(
        'id' => $row->id,
        'title' => $row->title,
        'start' => $row->start_event,
        'end' => $row->end_event
    );
}
echo json_encode($events);
?>
