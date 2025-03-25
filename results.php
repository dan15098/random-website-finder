<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/functions.php';

if (!isset($_SESSION['scan_results'])) {
    header('Location: index.php');
    exit;
}

$results = $_SESSION['scan_results'];
$domain = $results['domain'];
$subdomains = $results['subdomains'];
$ports = $results['ports'];
$vulnerabilities = $results['vulnerabilities'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan Results - Subdomain Scanner</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Subdomain Scanner</h1>
            <p>Find subdomains, open ports, and vulnerabilities for any website</p>
        </div>
    </header>
    
    <div class="container">
        <div class="results-container">
            <div class="results-header">
                <h2>Results for <?php echo htmlspecialchars($domain); ?></h2>
                <button id="exportBtn" class="export-btn">Export Report</button>
            </div>
            
            <div class="tabs">
                <div class="tab active" data-tab="subdomains">Subdomains</div>
                <div class="tab" data-tab="ports">Open Ports</div>
                <div class="tab" data-tab="vulnerabilities">Vulnerabilities</div>
            </div>
            
            <div id="subdomains" class="tab-content active">
                <?php if (empty($subdomains)): ?>
                    <p>No subdomains found.</p>
                <?php else: ?>
                    <ul class="subdomain-list">
                        <?php foreach ($subdomains as $subdomain): ?>
                            <li class="subdomain-item">
                                <span><?php echo htmlspecialchars($subdomain['url']); ?></span>
                                <span class="status active">Active (<?php echo htmlspecialchars($subdomain['ip']); ?>)</span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            
            <div id="ports" class="tab-content">
                <?php if (empty($ports)): ?>
                    <p>No open ports found.</p>
                <?php else: ?>
                    <ul class="ports-list">
                        <?php foreach ($ports as $port): ?>
                            <li class="port-item">
                                <span><?php echo htmlspecialchars($port['service']); ?> (Port <?php echo htmlspecialchars($port['port']); ?>)</span>
                                <span><?php echo htmlspecialchars($port['status']); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            
            <div id="vulnerabilities" class="tab-content">
                <?php if (empty($vulnerabilities)): ?>
                    <p>No vulnerabilities found.</p>
                <?php else: ?>
                    <ul class="vulnerabilities-list">
                        <?php foreach ($vulnerabilities as $vuln): ?>
                            <li class="vulnerability-item">
                                <div>
                                    <strong><?php echo htmlspecialchars($vuln['name']); ?></strong>
                                    <p><?php echo htmlspecialchars($vuln['description']); ?></p>
                                </div>
                                <span class="severity <?php echo htmlspecialchars($vuln['severity']); ?>">
                                    <?php echo htmlspecialchars($vuln['severity']); ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="back-link">
            <a href="index.php">Perform another scan</a>
        </div>
    </div>
    
    <footer>
        <div class="container">
            <p>This tool is for educational purposes only. Always get proper authorization before scanning any website.</p>
        </div>
    </footer>
    
    <script src="assets/script.js"></script>
</body>
</html>