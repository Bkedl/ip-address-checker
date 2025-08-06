from flask import Flask, request, jsonify

app = Flask(__name__)

BAD_IPS = [
    "100.200.300.400",
    "101.201.301.401",
    "102.202.302.402",
    "103.203.303.403"
]

def is_valid_ipv4(ip):
    parts = ip.split('.')
    if len(parts) != 4:
        return False
    return True 

def check_ip(ip):
    if ip in BAD_IPS:
        return "Bad IP"
    else:
        return "Good IP"

@app.route('/', methods=['GET'])
def check_ips():
    response = jsonify({})
    response.headers.add('Access-Control-Allow-Origin', '*')
    response.headers.add('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
    response.headers.add('Access-Control-Allow-Headers', 'Content-Type, Authorization')

    items = request.args.get('items')
    if not items:
        return jsonify({"error": True, "message": "No IP addresses provided"}), 400
    
    ips = [ip.strip() for ip in items.split(',') if ip.strip()]
    results = {ip: check_ip(ip) for ip in ips if is_valid_ipv4(ip)}  

    response = jsonify({
        "error": False,
        "items": items,
        "results": results
    })
    response.headers.add('Access-Control-Allow-Origin', '*')
    response.headers.add('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
    response.headers.add('Access-Control-Allow-Headers', 'Content-Type, Authorization')
    return response

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)

