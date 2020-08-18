<?php

spl_autoload_register(function($class_name) {
	include_once __DIR__ . "/" . $class_name . ".php";
});

use App\Library\Database;

$db = new Database();
$db = $db->GetInstance();

$sql = "select * from customer";
$stmt = $db->prepare($sql);

try
{
	if($row = $stmt->fetchAll())
	{
		echo $row;
	}
} catch (PDOException $exc)
{
	echo $exc;
}

use App\Controller\CustomerController;
use App\Controller\UserController;

$customerController = new CustomerController();

// $customerController->Create('Abebe', '0913189411');
// $customerController->Create('Beqele', '0909090909');

$output = $customerController->ReadAll();
// $customerController->Delete(1);
$output = $customerController->ReadAll();

var_dump($output);
var_dump($customerController->Count());

$userController = new UserController();

// $user = $userController->Create('2', 'whatis', 'really');
var_dump($userController->Count());
var_dump($userController->ReadAll());