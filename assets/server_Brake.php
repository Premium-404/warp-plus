<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $referrer = $_POST['warp_id'];

    $install_id = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 22);
    $key = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 43) . "=";
    $fcm_token = $install_id . ":APA91b" . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 134);
    $tos = gmdate("Y-m-d\TH:i:s") . "+02:00";

    $body = array(
        "key" => $key,
        "install_id" => $install_id,
        "fcm_token" => $fcm_token,
        "referrer" => $referrer,
        "warp_enabled" => false,
        "tos" => $tos,
        "type" => "Android",
        "locale" => "es_ES"
    );

    $data = json_encode($body);
    $url = 'https://api.cloudflareclient.com/v0a' . substr(str_shuffle("0123456789"), 0, 3) . '/reg';

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n" .
                         "Host: api.cloudflareclient.com\r\n" .
                         "Connection: Keep-Alive\r\n" .
                         "Accept-Encoding: gzip\r\n" .
                         "User-Agent: okhttp/3.12.1\r\n",
            'method'  => 'POST',
            'content' => $data,
        ),
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if (strpos($http_response_header[0], "200 OK") !== false) {
        echo "<pre>";
        echo "Success: 1 GB successfully added to your account by 404.\n";
        echo "</pre>";
    } else {
        echo "<pre>";
        echo "Error when connecting to server\n";
        echo "</pre>";
    }
} else {
    echo "Request False";
}
?>
