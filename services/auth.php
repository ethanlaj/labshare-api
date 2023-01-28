<?php
require_once __DIR__ . "/jwt.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$header_name = "X_AUTH_TOKEN";

function is_requestor_authorized()
{
	global $header_name;

	$jwt = $_SERVER["HTTP_$header_name"];
	if (!$jwt) return false;

	$jwt_payload = decode_key($jwt);
	return ($jwt_payload !== null);
}

function require_authorized()
{
	if (!is_requestor_authorized()) unauthorized();
}

function get_payload()
{
	global $header_name;

	if (is_requestor_authorized())
		return decode_key($_SERVER["HTTP_$header_name"]);
}

function unauthorized()
{
	http_response_code(401);
	die();
}
