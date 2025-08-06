const express = require('express');
const app = express();
const port = 3000;

module.exports = { getCountryFromIP, isIPv4Like };

function getCountryFromIP(ip) {
    const firstGroup = ip.split('.')[0];
    if (firstGroup === '100') {
        return 'US';
    } else if (firstGroup === '101') {
        return 'UK';
    } else if (firstGroup === '102') {
        return 'China';
    } else {
        return 'Unknown';
    }
}

function isIPv4Like(ip) {
    const parts = ip.split('.');
    return parts.length === 4;
}

app.get('/', (req, res) => {
    res.setHeader('Access-Control-Allow-Origin', '*');
    res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
    res.setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization');

    if (req.query.items) {
        const ips = req.query.items.split(',');
        const results = {};

        ips.forEach(ip => {
            ip = ip.trim();
            if (isIPv4Like(ip)) {
                results[ip] = getCountryFromIP(ip);
            }
        });

        res.json({
            error: false,
            items: req.query.items,
            results: results
        });
    } else {
        res.status(400).json({ // adding 400 for BE tesing (like task B)
            error: true,
            message: 'No IP addresses provided'
        });
    }
});

app.listen(port, () => {
    console.log(`IP Country Service running at http://localhost:${port}`);
});
