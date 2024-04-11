<?php
 
//accesskey
$valid_token  = 'shfdksjdakjshdfjknvkja';
$client_token = $_GET['token'];
$project      = $_GET['project'];
$client_ip    = $_SERVER['REMOTE_ADDR'];
 
$fs = fopen('./auto_hook.log', 'a');
fwrite($fs, '============================start==============================='.PHP_EOL);
fwrite($fs, 'date:'.date("Y-m-d H:i:s", time()).',request:['. $client_ip.']'.PHP_EOL);
 
if ($client_token !== $valid_token) {
    fwrite($fs, "TKOEN error-- [{$client_token}]".PHP_EOL);
    fclose($fs);
    exit(0);
}
 
$json = file_get_contents("php://input");
$data = json_decode($json, true);
fwrite($fs, 'Data: '.print_r($data, true).PHP_EOL);
 
switch ($project) {
    case 'web':
        $res = exec("/home/www/hook.sh", $result);
        break;
}
 
fwrite($fs, 'Data:'. print_r($result, true).PHP_EOL);
fwrite($fs, '============================end==============================='.PHP_EOL);
fclose($fs);
var_dump($result);

?>