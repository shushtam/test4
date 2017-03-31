<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function secondsToTime($seconds) {
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%a d, %H:%i:%s');
}

function stats() {
    date_default_timezone_set('UTC');

    $cpu = shell_exec('top -bn1 | grep "Cpu(s)" | sed "s/.*, *\([0-9.]*\)%* id.*/\1/" | awk \'{print 100 - $1}\'');
    $cpu = (float) trim($cpu);

    $ram = shell_exec("free | grep Mem | awk '{print $3/$2 * 100.0}'");
    $ram = (float) trim($ram);

    $uptime_seconds = shell_exec("cat /proc/uptime | cut -d' ' -f1");
    $uptime_seconds = (float) trim($uptime_seconds);

    $radius = strpos(shell_exec("service freeradius status"), 'running') !== false;

    $mysql = strpos(shell_exec("service mysql status"), 'running') !== false;

    $tx = shell_exec("ifconfig eno16777984 | grep -oP '(?<=TX bytes:)[0-9]*'");
    $tx = (float) trim($tx);

    $rx = trim(shell_exec("ifconfig eno16777984 | grep -oP '(?<=RX bytes:)[0-9]*'"));
    $rx = (float) trim($rx);

    if ($uptime_seconds == 0.0) {
        $uptime_seconds1 = 1;
    } else {
        $uptime_seconds1 = $uptime_seconds;
    }
    $uprate = round($tx / $uptime_seconds1 / 1024);
    $downrate = round($rx / $uptime_seconds1 / 1024);

    $default_stats = [
        'cpu' => '', 'ram' => '', 'mysql' => false,
        'radius' => false, 'uptime' => secondsToTime((int) $uptime_seconds1), 'uprate' => '',
        'downrate' => '', 'response' => 'empty stats'
    ];
    dd(shell_exec("ifconfig eno16777984 | grep -oP '(?<=TX bytes:)[0-9]*'"));
    if ($uptime_seconds != 0.0) {
        $stats = [
            'cpu' => $cpu,
            'ram' => $ram,
            'uptime' => secondsToTime((int) $uptime_seconds1),
            'radius' => $radius,
            'mysql' => $mysql,
            'uprate' => $uprate,
            'downrate' => $downrate,
            'response' => 'success'
        ];
    } else {
        $stats = $default_stats;
    }

    return $stats;
}

dd(stats());
