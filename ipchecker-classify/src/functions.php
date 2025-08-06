<?php

function isIPv4($ip) {
    $parts = explode('.', $ip);
    return count($parts) === 4;
}

function isIPv6($ip) {
    $parts = explode(':', $ip);
    $count = count($parts);
    return $count >= 2 && $count <= 8;
}

function classifyIPs($ips) {
    $ipsArray = explode(',', $ips);
    $results = [];

    foreach ($ipsArray as $ip) {
        $ip = trim($ip); 
        if (isIPv4($ip)) {
            $results[$ip] = 'IPv4';
        } elseif (isIPv6($ip)) {
            $results[$ip] = 'IPv6';
        } else {
            $results[$ip] = 'Invalid';
        }
    }

    return $results;
}