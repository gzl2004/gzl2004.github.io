<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

define ('DB_HOST', 'localhost');
define ('DB_USER', 'root');
define ('DB_PASS', '');
define('DB_NAME', 'pharmaniaga');

function strongPass($password) {
    if (strlen($password) < 8 || !preg_match('/\d/', $password ) || !preg_match('/[!@#$%^&*]/', $password )) {
        return "Password must have at least 9 character with combination of digit, alphabet and special character. ";
    }
}