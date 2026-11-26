<?php
$dbHost = '127.0.0.1';
$dbPort = '3306';
$dbName = 'moja_strona';
$dbUser = 'UZUPELNIJ_UZYTKOWNIKA';
$dbPass = 'UZUPELNIJ_HASLO';

$dsn = 'mysql:host=' . $dbHost . ';port=' . $dbPort . ';dbname=' . $dbName . ';charset=utf8mb4';

$pdo = new PDO($dsn, $dbUser, $dbPass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
]);