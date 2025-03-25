<?php
function isDomainAllowed($domain) {
    global $ALLOWED_DOMAINS;
    
    if (empty($ALLOWED_DOMAINS)) {
        return true;
    }
    
    foreach ($ALLOWED_DOMAINS as $allowed) {
        if (strpos($domain, $allowed) !== false) {
            return true;
        }
    }
    
    return false;
}

function validateDomain($domain) {
    // Remove http:// or https://
    $domain = preg_replace('#^https?://#', '', $domain);
    
    // Remove www.
    $domain = preg_replace('#^www\.#', '', $domain);
    
    // Remove paths
    $domain = explode('/', $domain)[0];
    
    // Validate domain pattern
    return preg_match('/^([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,}$/i', $domain);
}

function logScan($domain, $results) {
    // In a real implementation, you would log scans to a database
    // This is a placeholder for that functionality
    return true;
}
?>