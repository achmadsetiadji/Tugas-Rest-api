<?php
function get_employee($id)
{
    global $connection;
    $query = "SELECT * FROM tb_employee WHERE id = $id";
    $response = array();
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = $row;
    }
    header('Content-Type:application/json');
    echo json_encode($response);
}

function get_employees()
{
    global $connection;
    $query = "SELECT * FROM tb_employee";
    $response = array();
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = $row;
    }
    header('Content-Type:application/json');
    echo json_encode($response);
}

function insert_employee()
{
    global $connection;
    $data = json_decode(file_get_contents('php://input'), true);
    $name = $data['name'];
    $salary = $data['salary'];
    $age = $data['age'];

    $query = "INSERT INTO `tb_employee` (`id`, `name`, `salary`, `age`) VALUES (NULL, '" . $name . "', '" . $salary . "', '" . $age . "');";
    if (mysqli_query($connection, $query) > 0) {
        $response = array(
            'status' => 1,
            'status_message' => 'Employee Added Successfully.'
        );
    } else {
        $response = array(
            'status' => 0,
            'status_message' => 'Employee Addition Failed.'
        );
    }
    header('Content-Type:application/json');
    echo json_encode($response);
}

function update_employee($id)
{
    global $connection;
    $post_vars = json_decode(file_get_contents("php://input"), true);
    $name = $post_vars['name'];
    $salary = $post_vars['salary'];
    $age = $post_vars['age'];

    $query = "UPDATE `tb_employee` SET `name` = '" . $name . "', `salary` = '" . $salary . "', `age` = '" . $age . "' WHERE `tb_employee`.`id` =" . $id;
    if (mysqli_query($connection, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => 'Employee Updated Successfully.'
        );
    } else {
        $response = array(
            'status' => 0,
            'status_message' => 'Employee Updation Failed.'
        );
    }
    header('Content-Type:application/json');
    echo json_encode($response);
}

function delete_employee($id)
{
    global $connection;
    $query = "DELETE FROM `tb_employee` WHERE `tb_employee`.`id` = " . $id;
    if (mysqli_query($connection, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => 'Employee Deleted Successfully.'
        );
    } else {
        $response = array(
            'status' => 0,
            'status_message' => 'Employee Deletion Failed.'
        );
    }
    header('Content-Type:application/json');
    echo json_encode($response);
}
