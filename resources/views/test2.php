<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//echo mt_rand(0,10);
$timestamp = mt_rand(1, time());
$randomDate = date("Y-m-d H:i:s", $timestamp);
 
//Print it out.
echo $randomDate;

echo ("<br>");

$string = "2010-11-24";
$timestamp = strtotime($randomDate);
echo $timestamp;
echo "<br>";
echo date("d", $timestamp);