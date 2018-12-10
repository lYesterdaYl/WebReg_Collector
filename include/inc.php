<?php
/**
 * Created by PhpStorm.
 * User: Zhiyuan Du
 * Date: 12/7/2018
 * Time: 12:51 PM
 */

//database information
$db_server = 'localhost:3306';
$db_acc = 'root';
$db_pwd = '';
$db_name = '';
$db_code = 'utf8';

//connect to database
$mysqli = @new mysqli($db_server, $db_acc, $db_pwd);

if ($mysqli->connect_errno) {
    die("could not connect to the database:\n" . $mysqli->connect_error);
}
$mysqli->query("set names " . $db_code);
$select_db = $mysqli->select_db($db_name);
if (!$select_db) {
    die("could not connect to the db:\n" .  $mysqli->error);
}

//search information
$urls = "https://www.reg.uci.edu/perl/WebSoc";
$year_term = "2019-03";
$breadth = "ANY";
$department = "COMPSCI";            //department
$cocourse = "";
$course_code = "";                   //course id
$submit = "Display Web Results";

//email information
$send_email = 1;    //send email if 1, not send email if 0
$from = "";         //sender email
$to = "";           //receiver email
$name = "";         //sender name
$title = "";        //email title
$message = "";      //email body, please don't edit
$from_user = "";    //sender email username
$from_password = "";//sender email password

$info = array(
    "from" => $from,
    "to" => $to,
    "name" => $name,
    "title" => $title,
    "message" => $message,
    "from_user" => $from_user,
    "from_password" => $from_password
);