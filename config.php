<?php
// Database config (adjust host if needed)
$DB_HOST = 'localhost';
$DB_NAME = 'db6k5ljmoftrfa';
$DB_USER = 'uulevslgtrnau';
$DB_PASS = 'ld4dy42tkorz';

$mysqli = @new mysqli($DB_HOST, $DB_USER, $D
$mysqli->set_charset('utf8mb4');

// Small helpers
function esc($str){ return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8'); }
function get_int($key, $default=0){ return isset($_GET[$key]) ? max(0, intval($_GET[$key])) : $default; }
function get_str($key, $default=''){ return isset($_GET[$key]) ? trim($_GET[$key]) : $default; }
?>
B_PASS, $DB_NAME);
if ($mysqli->connect_errno) {
  http_response_code(500);
  die('Database connection failed.');
}
