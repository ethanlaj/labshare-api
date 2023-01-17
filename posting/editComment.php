<?PHP
require_once(__DIR__ . "/../util/validation.php");

if (isset($_POST["comment_id"]) && isset($_POST["content"]) && validate_input("comment", $_POST["content"])) {
	require_once(__DIR__ . "/../util/postFunctions.php");

	$comment_id = $_POST["comment_id"];
	$content = $_POST["content"];

	editComment($comment_id, $content);
} else {
	header("HTTP/1.1 400 Invalid parameters");
}
