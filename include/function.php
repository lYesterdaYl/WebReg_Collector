<?php
/**
 * Created by PhpStorm.
 * User: Zhiyuan Du
 * Date: 12/7/2018
 * Time: 12:53 PM
 */

error_reporting(E_ERROR);

use PHPMailer\PHPMailer\PHPMailer;

require 'include/PHPMailer/src/Exception.php';
require 'include/PHPMailer/src/PHPMailer.php';
require 'include/PHPMailer/src/SMTP.php';
include_once("include/inc.php");

function html_to_obj($html) {
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    return element_to_obj($dom->documentElement);
}

function element_to_obj($element) {
    $obj = array( "tag" => $element->tagName );
    foreach ($element->attributes as $attribute) {
        $obj[$attribute->name] = $attribute->value;
    }
    foreach ($element->childNodes as $subElement) {
        if ($subElement->nodeType == XML_TEXT_NODE) {
            $obj["html"] = $subElement->wholeText;
        }
        else {
            $obj["children"][] = element_to_obj($subElement);
        }
    }
    return $obj;
}

function httpPost($url, $param, $post_file=false){
    $oCurl = curl_init();
    if(stripos($url,"https://")!==FALSE) {
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($oCurl, CURLOPT_SSLVERSION, 1);
    }
    if (is_string($param) || $post_file) {
        $strPOST = $param;
    } else {
        $aPOST = array();
        foreach($param as $key=>$val){
            $aPOST[] = $key."=".urlencode($val);
        }
        $strPOST =  join("&", $aPOST);
    }
    curl_setopt($oCurl, CURLOPT_URL, $url);
    curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt($oCurl, CURLOPT_POST,true);
    curl_setopt($oCurl, CURLOPT_POSTFIELDS,$strPOST);
    $sContent = curl_exec($oCurl);
    $aStatus = curl_getinfo($oCurl);
    curl_close($oCurl);
    if(intval($aStatus["http_code"])==200) {
        return $sContent;
    } else {
        return false;
    }
}

function send_email($info){
    $info = json_decode($info, TRUE);
    $from = $info['from'];
    $to = $info['to'];
    $name = $info['name'];
    $title = $info['title'];
    $message = $info['message'];
    $from_user = $info['from_user'];
    $from_password = $info['from_password'];

    $mail             = new PHPMailer();
    $mail->IsSMTP();
//    $mail->SMTPDebug  = 2;
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = "ssl";
    $mail->Host       = "smtp.gmail.com";
    $mail->Port       = 465;
    $mail->Username   = $from;
    $mail->Password   = $from_password;

    $mail->SetFrom($from, $name);

    $mail->Subject    = $title;

    $mail->MsgHTML($message);

    $address = $to;
    $mail->AddAddress($address, $title);

    if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message sent!";
    }
}
