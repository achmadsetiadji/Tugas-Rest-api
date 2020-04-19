<?php
include("../connection.php");
include('controller.php');

$db = new dObj();
$connection = $db->getConnstring();

$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            get_employee($id);
        } else {
            get_employees();
        }
        break;

    case 'POST':
        insert_employee();
        break;

    case 'PUT':
        $id = intval($_GET["id"]);
        update_employee($id);
        break;

    case 'DELETE':
        $id = intval($_GET["id"]);
        delete_employee($id);
        break;
        
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
