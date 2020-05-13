import requests
 
wp_login = 'https://www.example.com/wp-login.php'
wp_admin = 'https://www.example.com/wp-admin/'
wp_rest = 'https://www.example.com/wp-json/specialplugin/v1/users/10'
username = 'admin'
password = 'password'

with requests.Session() as s:
    headers1 = { 'Cookie':'wordpress_test_cookie=WP Cookie check' }
    datas={ 
        'log':username, 'pwd':password, 'wp-submit':'Log In', 
        'redirect_to':wp_admin, 'testcookie':'1'  
    }
    s.post(wp_login, headers=headers1, data=datas)
    resp = s.get(wp_rest)
    print(resp.text)
