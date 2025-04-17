<?php



function curl_req($url, $data){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch);
    curl_close($ch);
    return $res;
};

function infoTextSend($mobile, $sms){
    $sms_data = [
        'UserID' => '669',
        'ApiKey' => '207bb08817f8ab47ac813b6b8917de0d',
        'Mobile' => $mobile,
        'SMS' => $sms,
    ];
    
    curl_req('https://api.myinfotxt.com/v2/send.php', $sms_data);
}

?>