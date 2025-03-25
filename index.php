<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/functions.php';

if (isset($_SESSION['scan_results'])) {
    unset($_SESSION['scan_results']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subdomain Scanner</title>
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Subdomain Scanner</h1>
            <p>Find subdomains, open ports, and vulnerabilities for any website</p>
        </div>
    </header>
    
    <div class="container">
        <div class="search-container">
            <form id="scanForm" class="search-form" action="scan.php" method="POST">
                <input type="text" id="domainInput" name="domain" class="search-input" 
                       placeholder="Enter domain (e.g., example.com)" required>
                <button type="submit" class="search-btn">Scan</button>
            </form>
        </div>
        
        <div id="loading" class="loading" style="display: none;">
            <div class="spinner"></div>
            <p>Scanning domain. This may take a few minutes...</p>
        </div>
        
        <div class="disclaimer">
            <p><strong>Note:</strong> This scanner has limited capabilities on InfinityFree due to server restrictions. For full functionality, consider a VPS with proper permissions.</p>
        </div>
    </div>
    
    <footer>
        <div class="container">
            <p>This tool is for educational purposes only. Always get proper authorization before scanning any website.</p>
        </div>
    </footer>
    
    <script src="assets