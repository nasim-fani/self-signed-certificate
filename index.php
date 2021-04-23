<?php
    header('Content-type: text/plain');
    // $data = openssl_x509_parse(file_get_contents('nasim-fani.cert.pem'));
    $contextCreate = stream_context_create(array("ssl" => array("capture_peer_cert" => true)));
    $res = stream_socket_client("ssl://npmjs.com:443", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $contextCreate);
    $context = stream_context_get_params($res);
    $data = openssl_x509_parse($context["options"]["ssl"]["peer_certificate"]);    
    // print_r(json_encode($data) );
    $validFrom = date('F j, Y', $data['validFrom_time_t']);
    $validTo = date('F j, Y', $data['validTo_time_t']);
    $commonName = $data['subject']['CN'];
    $issuer = $data['issuer']['CN'];       
    echo "Common Name: ".$commonName."\n";
    echo "Valid From: ".$validFrom . "\n";
    echo "Valid To: ".$validTo . "\n";
    echo "Issuer: ".$issuer . "\n";
?>
