<?php
try {
    $db = new PDO('mysql:host=127.0.0.1', 'root', 'andi');
    $db->exec('CREATE DATABASE IF NOT EXISTS schola_admin');
    echo "SUCCESS";
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
