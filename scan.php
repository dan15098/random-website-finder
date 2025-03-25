<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$domain = filter_input(INPUT_POST, 'domain', FILTER_SANITIZE_STRING);

if (empty($domain)) {
    $_SESSION['error'] = 'Please enter a valid domain';
    header('Location: index.php');
    exit;
}


if (!preg_match('/^([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,}$/i', $domain)) {
    $_SESSION['error'] = 'Invalid domain format';
    header('Location: index.php');
    exit;
}


$subdomains = scanSubdomains($domain);
$ports = scanPorts($domain);
$vulnerabilities = scanVulnerabilities($domain);

$_SESSION['scan_results'] = [
    'domain' => $domain,
    'subdomains' => $subdomains,
    'ports' => $ports,
    'vulnerabilities' => $vulnerabilities,
    'timestamp' => time()
];

header('Location: results.php');
exit;

function scanSubdomains($domain) {
    
    
    $commonSubdomains = [
        'www', 'mail', 'ftp', 'blog', 'shop', 'api', 
        'dev', 'test', 'staging', 'admin', 'secure'
    ];
    
    $results = [];
    
    foreach ($commonSubdomains as $sub) {
        $host = "$sub.$domain";
        $ip = gethostbyname($host);
        
        if ($ip !== $host) {
            $results[] = [
                'url' => $host,
                'ip' => $ip,
                'active' => true
            ];
        }
    }
    
    return $results;
}

function scanPorts($domain) {
   
    
    $commonPorts = [
        80 => 'HTTP',
        443 => 'HTTPS',
        21 => 'FTP',
        22 => 'SSH',
        25 => 'SMTP',
        3306 => 'MySQL'
    ];
    
    $results = [];
    
    foreach ($commonPorts as $port => $service) {
        
        if (rand(0, 1)) {
            $results[] = [
                'port' => $port,
                'service' => $service,
                'status' => 'Open'
            ];
        }
    }
    
    return $results;
}

function scanVulnerabilities($domain) {
    
    
    $vulnerabilities = [];
    
    
    if (rand(0, 1)) {
        $vulnerabilities[] = [
            'name' => 'No HTTPS',
            'description' => 'Website is not using HTTPS, which can expose sensitive data',
            'severity' => 'high'
        ];
    }
    
    
    if (rand(0, 1)) {
        $vulnerabilities[] = [
            'name' => 'Missing Security Headers',
            'description' => 'Important security headers like X-XSS-Protection are missing',
            'severity' => 'medium'
        ];
    }
    
    return $vulnerabilities;
}
?>