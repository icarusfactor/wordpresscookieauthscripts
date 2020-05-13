curl -c cookie.txt -F log=admin -F pwd='password' https://www.example.com/wp-login.php
curl -o output.html --cookie cookie.txt https://www.exmaple.com/wp-json/specialplugin/v1/users/10
