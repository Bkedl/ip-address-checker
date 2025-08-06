const http = require('http');

const services = {
    "totalips": "http://totalips.40154530.qpc.qubcloud.uk/",
    "emptyips": "http://emptyips.40154530.qpc.qubcloud.uk/",
    "validips": "http://validips.40154530.qpc.qubcloud.uk/",
    "classifyips": "http://classifyips.40154530.qpc.qubcloud.uk/",
    "countryinfo": "http://counrtyinfo.40154530.qpc.qubcloud.uk/",
    "badips": "http://badips.40154530.qpc.qubcloud.uk/"
};

//need this empty arry to store the reuslts of the services 
let results = [];

function getRandomString(length) {
    const characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    let result = '';
    for (let i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    return result;
}

function getRandomIP() {
    if (Math.random() > 0.5) {
        return `${getRandomString(3)}.${getRandomString(3)}.${getRandomString(3)}.${getRandomString(3)}`;
    } else {
        let ipv6 = '';
        const groupCount = Math.floor(Math.random() * 7) + 2;
        for (let i = 0; i < groupCount; i++) {
            ipv6 += getRandomString(4);
            if (i < groupCount - 1) {
                ipv6 += ':';
            }
        }
        return ipv6;
    }
}

function testServices() {
    results = [];
    for (const [name, url] of Object.entries(services)) {
        const ip = getRandomIP();
        const startTime = Date.now();

        http.get(`${url}?items=${ip}`, (res) => {
            res.on('data', () => { });

            res.on('end', () => {
                const timeTaken = Date.now() - startTime;
                const resultString = `${name} took ${timeTaken}ms with IP: ${ip}`;
                results.push(resultString);  // canigng this about as there is an issue in the rancher part, i know i wsnt pushing to reuslts array, but want t ensure debugging is clearer
                console.log(resultString);
            });
        }).on('error', (err) => {
            const errorString = `Error with ${name}: ${err.message}`;
            results.push(errorString);  // and again the results push and better clearer debugging 
            console.error(errorString);
        });
    }
}

// adding thi to see it on the ingress then 
const server = http.createServer((req, res) => {
    res.writeHead(200, { 'Content-Type': 'application/json' });
    res.end(JSON.stringify(results));
});

const PORT = process.env.PORT || 3000;
server.listen(PORT, () => {
    console.log(`Server running on port ${PORT}`);
});

setInterval(testServices, 20000); // updated as 10 was a bit short since it was buffering alot on rancher 

console.log('Monitoring service started, checking every 20 seconds...'); // needed to chnage this too 