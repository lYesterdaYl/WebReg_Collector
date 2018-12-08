<?php
/**
 * Created by PhpStorm.
 * User: Zhiyuan Du
 * Date: 12/7/2018
 * Time: 12:51 PM
 */

//search information
$urls = "https://www.reg.uci.edu/perl/WebSoc";
$year_term = "2019-03";
$breadth = "ANY";
$department = "COMPSCI";            //department
$cocourse = "";
$course_code = "";                   //course id
$submit = "Display Web Results";

//email information
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