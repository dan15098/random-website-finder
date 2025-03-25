document.addEventListener('DOMContentLoaded', function() {
    
    const tabs = document.querySelectorAll('.tab');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            
            tabs.forEach(t => t.classList.remove('active'));
            tabContents.forEach(c => c.classList.remove('active'));
            
            
            tab.classList.add('active');
            const tabId = tab.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });
    
    
    const scanForm = document.getElementById('scanForm');
    if (scanForm) {
        scanForm.addEventListener('submit', function() {
            const loading = document.getElementById('loading');
            if (loading) loading.style.display = 'block';
        });
    }
    
    
    const exportBtn = document.getElementById('exportBtn');
    if (exportBtn) {
        exportBtn.addEventListener('click', function() {
            const domain = document.querySelector('.results-header h2')?.textContent.replace('Results for ', '') || 'scan-results';
            const timestamp = new Date().toISOString().replace(/[:.]/g, '-');
            
            let exportContent = `Subdomain Scanner Report\n`;
            exportContent += `Domain: ${domain}\n`;
            exportContent += `Generated on: ${new Date().toLocaleString()}\n\n`;
            
    
            exportContent += "=== SUBDOMAINS ===\n";
            document.querySelectorAll('.subdomain-item').forEach(item => {
                const url = item.querySelector('span:first-child').textContent;
                const status = item.querySelector('.status').textContent;
                exportContent += `${url} - ${status}\n`;
            });
            

            exportContent += "\n=== OPEN PORTS ===\n";
            document.querySelectorAll('.port-item').forEach(item => {
                const service = item.querySelector('span:first-child').textContent;
                const status = item.querySelector('span:last-child').textContent;
                exportContent += `${service} - ${status}\n`;
            });
            
            
            exportContent += "\n=== VULNERABILITIES ===\n";
            document.querySelectorAll('.vulnerability-item').forEach(item => {
                const name = item.querySelector('strong').textContent;
                const desc = item.querySelector('p').textContent;
                const severity = item.querySelector('.severity').textContent;
                exportContent += `${name} (${severity})\n${desc}\n\n`;
            });
            
    
            const blob = new Blob([exportContent], { type: 'text/plain' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `subdomain-scan-${domain}-${timestamp}.txt`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        });
    }
});