<?PHP

if (isset($_POST["post_id"])) {
	require_once(__DIR__ . "/../util/postFunctions.php");

	$post_id = $_POST["post_id"];

	deletePost($post_id);
} else {
	header("HTTP/1.1 400 Invalid parameters");
}
