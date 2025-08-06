import unittest
from src.app import is_valid_ipv4, check_ip

class TestBadIPChecker(unittest.TestCase):

    def test_is_valid_ipv4(self):
        self.assertTrue(is_valid_ipv4('123.456.abc.def'))
        self.assertTrue(is_valid_ipv4('000.111.222.333'))  
        self.assertTrue(is_valid_ipv4('...')) 
        self.assertTrue(is_valid_ipv4('a.b.c.d')) 
        self.assertFalse(is_valid_ipv4('123.456.789')) 
        self.assertFalse(is_valid_ipv4('123.456.789.012.345')) 
        self.assertFalse(is_valid_ipv4('123.456.789..'))  

    def test_check_ip(self):
        self.assertEqual(check_ip('100.200.300.400'), 'Bad IP')
        self.assertEqual(check_ip('101.201.301.401'), 'Bad IP')
        self.assertEqual(check_ip('123.456.789.012'), 'Good IP')
        self.assertEqual(check_ip('000.111.222.333'), 'Good IP')
        self.assertEqual(check_ip('abc.def.ghi.jkl'), 'Good IP')  

    def test_check_ip_with_invalid_format(self):
        self.assertFalse(is_valid_ipv4('123.456.789'))
        self.assertFalse(is_valid_ipv4('123.456.789.012.345')) 

if __name__ == '__main__':
    unittest.main()