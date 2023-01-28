<?php
require_once __DIR__ . "/../services/auth.php";
require_once __DIR__ . "/../services/jwt.php";
require_once __DIR__ . "/../services/validate.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Content-Type: text/plain");

$method = $_SERVER['REQUEST_METHOD'];
$req_body = file_get_contents('php://input');
$body = json_decode($req_body, true);

/**
 *  POST account/login
 *  Authentication Not Required
 * 	Parameter: JSON:
 * 	{
 * 		email: user@domain.com
 * 		password: pwd
 * 	}
 * 	Returned Data: String - A JWT Token
 */
if ($method == 'POST') {
	/**
	 * if (!email || !password)
	 * 		if (Valid JWT token)
	 * 			Return a new JWT Token
	 * 		else
	 * 			401 Unauthorized
	 */

	if (isset($body["email"]) && isset($body["password"])) {
		array_validate("login", $body);
	} else if (is_requestor_authorized()) {
		$payload = set_payload_times(get_payload());
		var_dump($payload);
	} else {
		http_response_code(401);
		die();
	}
}
