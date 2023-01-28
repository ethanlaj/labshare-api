<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// require_once __DIR__ . "/../services/auth.php";
// require_once __DIR__ . "/../services/jwt.php";
// require_once __DIR__ . "/../services/validate.php";

require_once __DIR__ . "/../util/postFunctions.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$req_body = file_get_contents('php://input');
$body = json_decode($req_body, true);

/**
 *  GET posting/post
 *  Authentication Not Required
 * 	Parameter: JSON:
 * 	{
 * 		type: your
 * 		search: Science
 * 	}
 * 	Returned Data: JSON
 */
if ($method == 'GET') {
	$type = isset($body["type"]) ? $body["type"] : null;
	$search = isset($body["search"]) ? $body["search"] : null;

	$posts = getPosts($type, $search);

	echo json_encode($posts);
}
