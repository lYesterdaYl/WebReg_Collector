<?php
/**
 * Created by PhpStorm.
 * User: Zhiyuan Du
 * Date: 12/7/2018
 * Time: 12:12 PM
 */

include_once("include/inc.php");
include_once("include/function.php");


$parData=array(
    'YearTerm'=>$year_term,
    'Breadth'=>"",
    'Dept'=>$department,
    'CourseCodes'=>$course_code,
    'Submit'=>$submit
);

$datas=httpPost($urls,$parData);
echo "<pre>";
//print_r($datas);

//$datas = explode(" ", $datas);
//print_r($datas);



$datas = html_to_obj($datas);
print_r($datas);



