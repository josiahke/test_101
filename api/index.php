<?php
/**
 * Created by PhpStorm.
 * User: josiah
 * Date: 01/05/2018
 * Time: 00:48
 */
include ('endpoints.php');

foreach ($endPoints as $list ) {
    $tracker  = [];
    $tracker['start_time'] = date('d-m-Y h:i:s');
    $curl = curl_init();
    // You can also set the URL you want to communicate with by doing this:
    // $curl = curl_init('http://localhost/echoservice');
    // We POST the data
    if ($list['method'] == 'POST') {
        curl_setopt($curl, CURLOPT_POST, 1);
    }
    else {
       // curl_setopt($curl, CURLOPT_GET, 1);
    }
    // Set the url path we want to call
    if ($list['method'] == 'POST') {
        curl_setopt($curl, CURLOPT_URL, $list['base_url']);
    }
    else {
        $hashinput = null;
        foreach($list['data']  as $key => $value) {
            $hashinput .= $key . "=" . $value . "&";
        }
        $hashinput = rtrim($hashinput, "&");
        curl_setopt($curl, CURLOPT_URL, $list['base_url'].'?'.$hashinput);
    }
    // Make it so the data coming back is put into a string
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    // Insert the data
    if ($list['method'] == 'POST') {
        curl_setopt($curl, CURLOPT_POSTFIELDS, $list['data']);
    }
    // You can also bunch the above commands into an array if you choose using: curl_setopt_array
    // Send the request
    $result = curl_exec($curl);
    // Get some cURL session information back

    $info = curl_getinfo($curl);

    echo 'content type: ' . $info['content_type'] . '<br />';
    echo 'http code: ' . $info['http_code'] . '<br />';
    echo 'Took ', $info['total_time'], ' seconds to send a request to ', $info['url'], "\n";

    $tracker['response_code'] = $info['http_code'];
    $tracker['response_time'] = $info['total_time'];

    // Free up the resources $curl is using
    curl_close($curl);

    $fp = fopen('response.csv', 'w');
    foreach ($tracker as $fields) {
        fputcsv($fp, $fields);
    }
    fclose($fp); 

    echo $result;

}

?>


