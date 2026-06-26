<?php
session_start(); // if you later add auth

$base_dir = '/home/nhuufdqr/invoice/'; // OUTSIDE public_html

if (!isset($_GET['file'])) {
    die("No file specified");
}

$file = basename($_GET['file']); // prevents ../ attack
$full_path = realpath($base_dir . $file);

// ✅ Ensure file is inside allowed directory
if ($full_path === false || strpos($full_path, $base_dir) !== 0) {
    die("Access denied");
}

if (!file_exists($full_path)) {
    die("File not found");
}

// OPTIONAL: check user permission here

// Detect MIME
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $full_path);
finfo_close($finfo);

// Serve file
header('Content-Type: ' . $mime);
header('Content-Length: ' . filesize($full_path));
header('Content-Disposition: inline; filename="' . basename($full_path) . '"');

readfile($full_path);
exit;
?>