<?PHP

if (isset($_POST["comment_id"])) {
	require_once(__DIR__ . "/../../database/postFunctions.php");

	$comment_id = $_POST["comment_id"];

	deleteComment($comment_id);
} else {
	header("HTTP/1.1 400 Invalid parameters");
}
