<?php
 
$url_rest = "https://www.example.com/wp-json/specialplugin/v1/users/10";
$url = "https://www.example.com/wp-login.php";
$cookie = "/tmp/cookie.txt"; // I was running the code on localhost, and hence the path!
$fields_string = '';
$user = "admin";
$pass = "password";
$fields = array(
            'log'=>urlencode($user),
            'pwd'=>urlencode($pass),
        );
 
//url-ify the data for the POST
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string,'&');
 
    $ch = curl_init ();
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch,  CURLOPT_HEADER,  1);
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,20);
    curl_setopt( $ch, CURLOPT_USERAGENT, 'PHP cURL Request Client');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch,CURLOPT_POST,count($fields));
    curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_NOBODY, 0);
    curl_setopt ($ch, CURLOPT_COOKIEFILE, $cookie); 
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // These are only used if you are using SSL
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

    
    $data = curl_exec ($ch);
    curl_close($ch);
    print( $data );

    $ch = curl_init ();
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_URL,$url_rest);

    curl_setopt($ch,  CURLOPT_HEADER,  1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,10);
    curl_setopt( $ch, CURLOPT_USERAGENT, 'PHP cURL Request Client');
    curl_setopt ($ch, CURLOPT_COOKIEFILE, $cookie); 
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    // Return Page contents. 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // These are only used if you are using SSL
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

    $output = curl_exec ($ch);
    curl_close($ch);
    unlink( $cookie ); // Youhave to get rid of the cookie or future calls will hang.
    print( $output );
?>
