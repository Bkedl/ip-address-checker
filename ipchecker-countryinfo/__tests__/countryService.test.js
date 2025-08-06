const { getCountryFromIP, isIPv4Like } = require('../src/index');

describe('getCountryFromIP', () => {
    test('should return "US" for IPs starting with "100"', () => {
        expect(getCountryFromIP('100.123.456.789')).toBe('US');
        expect(getCountryFromIP('100.999.888.777')).toBe('US');
    });

    test('should return "UK" for IPs starting with "101"', () => {
        expect(getCountryFromIP('101.123.456.789')).toBe('UK');
    });

    test('should return "China" for IPs starting with "102"', () => {
        expect(getCountryFromIP('102.123.456.789')).toBe('China');
    });

    test('should return "Unknown" for IPs with other prefixes', () => {
        expect(getCountryFromIP('103.123.456.789')).toBe('Unknown');
        expect(getCountryFromIP('110.111.222.333')).toBe('Unknown');
        expect(getCountryFromIP('1001.111.222.333')).toBe('Unknown'); // added this for first 3 digits being 100 but then no split so not US
    });
});

describe('isIPv4Like', () => {
    test('should return true for valid IPv4-like addresses', () => {
        expect(isIPv4Like('123.456.789.0')).toBe(true);
        expect(isIPv4Like('0e.0e.0e.0e')).toBe(true); // wanted to add letters as prevuous regex I experineted with wouldnt allow this 
        expect(isIPv4Like('aaa.aaa.aaa.aaa')).toBe(true); // same as above reason
    });

    test('should return false for non-IPv4-like addresses', () => {
        expect(isIPv4Like('123.456.789')).toBe(false);  // all these are not ipv4 variations so false resposne 
        expect(isIPv4Like('123:456:789:0')).toBe(false);
        expect(isIPv4Like('192.168.0')).toBe(false);
        expect(isIPv4Like('192.168.0.1.1')).toBe(false);
    });
});

describe('getCountryFromIP with IPv4-like validation', () => {
    test('should only classify IPv4-like addresses', () => {
        expect(isIPv4Like('192.168.1.1')).toBe(true); // adding both expoerted functions togethe to see if the tests will run 
        expect(isIPv4Like('123.456.789.0')).toBe(true);
        expect(isIPv4Like('123:456:789:0')).toBe(false);
        expect(isIPv4Like('abcd.efgh.ijkl.mnop')).toBe(true);
        expect(getCountryFromIP('192.168.1.1')).toBe('Unknown');
        expect(getCountryFromIP('103.123.456.789')).toBe('Unknown');
        expect(getCountryFromIP('abcd.efgh.ijkl.mnop')).toBe('Unknown');
    });
});