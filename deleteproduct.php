<?php

// Initialize an empty $id variable
$id = '';
$code = '';

// Check if 'id' is set in the GET request and assign it to $id if it exists
if (isset($_GET['id']) && isset($_GET['code'])) {
    $id = $_GET['id'];
    $code = $_GET['code'];
}

// Include the product class file that contains the Product class definition
require_once 'product.class.php';

// Create an instance of the Product class
$obj = new Product();

// Call the delete method of the Product class with the $id parameter
// If deletion is successful, output 'success'; otherwise, output 'failed'
if ($obj->delete($id, $code)) {
    echo 'success';
} else {
    echo 'failed';
}
