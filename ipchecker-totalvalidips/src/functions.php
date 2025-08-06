<?php

function isValidIPv4($ip) {
    $parts = explode('.', $ip);
    return count($parts) === 4;
}

function isValidIPv6($ip) {
    $parts = explode(':', $ip);
    $count = count($parts);
    return $count >= 2 && $count <= 8;
}

function validateIPs($ips) {
    $ipsArray = explode(',', $ips);
    $results = [];

    foreach ($ipsArray as $ip) {
        $ip = trim($ip); 
        if (isValidIPv4($ip) || isValidIPv6($ip)) {
            $results[$ip] = 'Valid';
        } else {
            $results[$ip] = 'Invalid';
        }
    }

    return $results;
}


