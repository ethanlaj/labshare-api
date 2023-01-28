<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Validation\Validation as V;

function array_validate($key, $input_arr)
{
	global $schemas;

	V::validate($input_arr, $schemas[$key], function ($err) {
		if ($err !== null) {
			print_r($err);

			header("HTTP/1.1 400 Validation Failed");
			die();
		}
	});
}

// DELETE WHEN DONE
function generate_arr()
{
}
$THIS_IS_OLD_DO_NOT_USE = array(
	"username" => generate_arr(true, "/^[A-Za-z\d]+$/", 3, 20),
	"password" => generate_arr(true, "/^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=!]).*$/", 8),
	"new_password" => generate_arr(false, "/^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=!]).*$/", 8),
	"firstName" => generate_arr(true, "/^[A-Za-z\d?=']+$/", 1, 20),
	"lastName" => generate_arr(true, "/^[A-Za-z\d?=']+$/", 1, 30),
	"email" => generate_arr(true, "/^[a-zA-Z0-9.!#$%&’*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/"),
	"phone" => generate_arr(false, "/^\(?([0-9]{3,4})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/"),
	"birthday" => generate_arr(true, "/^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/"),

	"quals_degress" => generate_arr(false, "/^[\s\S]+$/"),
	"area_of_study" => generate_arr(false, "/^[\s\S]+$/"),
	"yearsInField" => generate_arr(false, "/^[\s\S]+$/"),
	"secondary_area_of_study" => generate_arr(false, "/^[\s\S]+$/"),
	"summary" => generate_arr(false, null),
	"about" => generate_arr(false, null),
);
//

$defaults = array(
	// shared
	"id" => V::number()->required(),

	// posting
	"zip" => V::string()->regex("/^[0-9]{5}$/")->defaultValue(''),
	"title" => V::string()->min(10)->max(50)->required(),
	"postContent" => V::string()->min(50)->max(2000)->required(),
	"comment" => V::string()->min(10)->max(500)->required(),
);

$schemas = array(
	"id" => V::arr()->keys([
		"id" => $defaults["id"],
	]),
	"createPost" => V::arr()->keys([
		"title" => $defaults["title"],
		"content" => $defaults["postContent"],
		"zip" => $defaults["zip"],
	]),
	"editPost" => V::arr()->keys([
		"id" => $defaults["id"],
		"title" => $defaults["title"],
		"content" => $defaults["postContent"],
		"zip" => $defaults["zip"],
	])
);
