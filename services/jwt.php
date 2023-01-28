<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$key = getenv("COMMUNITY_JWT_KEY");

function set_payload_times($payload)
{
	$payload['iat'] = floor(microtime(true));
	// 86400 is 1 day in seconds
	$payload['exp'] = floor(microtime(true) + 86400);

	return $payload;
}

function generate_key($userID, $email, $firstName, $lastName, $permissionLevel)
{
	global $key;

	$payload = set_payload_times([
		'userID' => $userID,
		'email' => $email,
		'firstName' => $firstName,
		'lastName' => $lastName,
		'permissionLevel' => $permissionLevel,
	]);

	return JWT::encode($payload, $key, 'HS256');
}

function decode_key($jwt)
{
	global $key;

	try {
		$decoded = JWT::decode($jwt, new Key($key, 'HS256'));
		return (array) $decoded;
	} catch (Exception $e) {
		return null;
	}
}
