<?PHP
header("Content-Type: application/json");

require_once(__DIR__ . "/../util/postFunctions.php");

$type = isset($_GET["type"]) ? $_GET["type"] : null;
$search = isset($_GET["search"]) ? $_GET["search"] : null;

$posts = getPosts($type, $search);

echo json_encode($posts);
