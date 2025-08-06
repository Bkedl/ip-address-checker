const http = require('http');
const url = require('url');

const PORT = process.env.PORT || 3000;

http.createServer((req, res) => {
    res.setHeader('Access-Control-Allow-Origin', '*');
    res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
    res.setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization');

    const queryObject = url.parse(req.url, true).query;
    const service = queryObject.service;
    const items = queryObject.items;

    let targetUrl;

    // Set targetUrl based on the service parameter
    if (service === 'totalips') {
        targetUrl = `http://totalips.40154530.qpc.qubcloud.uk/?items=${items}`;
    } else if (service === 'emptyips') {
        targetUrl = `http://emptyips.40154530.qpc.qubcloud.uk/?items=${items}`;
    } else if (service === 'validips') {
        targetUrl = `http://validips.40154530.qpc.qubcloud.uk/?items=${items}`;
    } else if (service === 'classifyips') {
        targetUrl = `http://classifyips.40154530.qpc.qubcloud.uk/?items=${items}`;
    } else if (service === 'countryinfo') {
        targetUrl = `http://counrtyinfo.40154530.qpc.qubcloud.uk/?items=${items}`;
    } else if (service === 'badips') {
        targetUrl = `http://badips.40154530.qpc.qubcloud.uk/?items=${items}`;
    } else {
        res.writeHead(400, { 'Content-Type': 'text/plain' });
        res.end('Service not found');
        return;
    }

    console.log(`Forwarding req : ${targetUrl}`);

    http.get(targetUrl, (backendRes) => {
        res.setHeader('Access-Control-Allow-Origin', '*');
        res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
        res.setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        backendRes.pipe(res);
    }).on('error', (err) => {
        console.error(`Error regarding ${targetUrl}: ${err.message}`);
        res.writeHead(500, { 'Content-Type': 'text/plain' });
        res.end('Internal server error');
    });

}).listen(PORT, () => {
    console.log(`Reverse proxy running on ${PORT}`);
});