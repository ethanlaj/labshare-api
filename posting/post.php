<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// require_once __DIR__ . "/../services/auth.php";
// require_once __DIR__ . "/../services/jwt.php";
require_once __DIR__ . "/../services/validate.php";

require_once __DIR__ . "/../util/postFunctions.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$req_body = file_get_contents('php://input');
$body = json_decode($req_body, true);

/**
 *  GET posting/post
 *  Authentication Not Required
 * 	Parameter: JSON:
 * 	{
 * 		id: 1
 * 	}
 * 	Returned Data: JSON
 */
if ($method == 'GET') {
	array_validate("id", $body);

	echo json_encode(getPost($body["id"]), true);
}

/**
 *  POST posting/post
 *  Authentication Required
 * 	Parameter: JSON:
 * 	{
 * 		title: Post Title
 * 		content: Post Content
 * 		zip: 123456
 * 	}
 * 	Returned Data: JSON: 
 * 	{
 * 		id: 1
 * 		title: Post Title
 * 		content: Post Content
 * 		zip: 12345
 * 	}
 */
if ($method == 'POST') {
	array_validate("createPost", $body);

	$zip = isset($body["zip"]) ? $body["zip"] : null;

	$new_post_id = createPost($body["title"], $body["content"], $zip ? $zip : null);
}

/**
 *  PUT posting/post
 *  Authentication Required
 * 	Parameter: JSON:
 * 	{
 * 		id: 1
 * 		title: Post Title
 * 		content: Post Content
 * 		zip: 123456
 * 	}
 * 	Returned Data: JSON: 
 * 	{
 * 		id: 1
 * 		title: Post Title
 * 		content: Post Content
 * 		zip: 12345
 * 	}
 */
if ($method == 'PUT') {
	array_validate("editPost", $body);

	$zip = isset($body["zip"]) ? $body["zip"] : null;

	editPost($body["id"], $body["title"], $body["content"], $zip ? $zip : null);
}

/**
 *  DELETE posting/post
 *  Authentication Required
 * 	Parameter: JSON:
 * 	{
 * 		id: 1
 * 	}
 * 	Returned Data: JSON: 
 * 	{
 * 		id: 1
 * 		title: Post Title
 * 		content: Post Content
 * 		zip: 12345
 * 	}
 */
if ($method == 'DELETE') {
	array_validate("id", $body);

	deletePost($body["id"]);
}
