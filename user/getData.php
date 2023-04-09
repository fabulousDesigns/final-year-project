<?php
// Code to fetch data from database or other source
$data = array(
    "name" => "John Doe",
    "age" => 30,
    "email" => "johndoe@example.com"
);

// Output the data as JSON
header('Content-Type: application/json');
echo json_encode($data);
