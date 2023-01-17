<?PHP

header("Content-Type: application/json");

require_once(__DIR__ . "/../util/notificationFunctions.php");

$notifications = get_notifications();

echo json_encode($notifications);
