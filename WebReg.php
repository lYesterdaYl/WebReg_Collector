<?php
/**
 * Created by PhpStorm.
 * User: Zhiyuan Du
 * Date: 12/7/2018
 * Time: 12:12 PM
 */

include_once("include/inc.php");
include_once("include/function.php");
//include_once("include/inc_ignore.php");
//include('../../../../system_files/inc.php');

$parData=array(
    'YearTerm'=>$year_term,
    'Breadth'=>"",
    'Dept'=>$department,
    'CourseCodes'=>$course_code,
    'CoCourse' => $cocourse,
    'Submit'=>$submit
);

$datas = httpPost($urls, $parData);

$datas = html_to_obj($datas);
$result = result_anlysis($datas, $mysqli);
$info['message'] = $result['message'];
if($result['availability'] == TRUE){
    // send email
    if($send_email == 1){
        send_email(json_encode($info));
    }
}

