<?php
require 'include/global.php';
require 'include/httpClient.php';

function get_update(){
    global $httpClient;

    $limit = 20;
    $params = array(
        'limit' => $limit,
        'order' => 'asc',
        'short_name' => DUOSHUO_NAME,
        'secret' => DUOSHUO_SA
    );
    $fv = new QwbFileVar("discuss");
    $last_log_id = $fv->get("last_id");
    if(!strlen($last_log_id)) $last_log_id = "0";

    $params['since_id'] = $last_log_id;
    $httpClient->get('http://api.duoshuo.com/log/list.json', $params);
    $response = json_decode($httpClient->buffer, true);

    print_r($response);

    if (!isset($response['response'])) {
        //处理错误,错误消息$response['message'], $response['code']
        //...

    } else {
        //遍历返回的response，你可以根据action决定对这条评论的处理方式。
        foreach($response['response'] as $log) {
            if(isset($log['meta']) && isset($log['meta']['thread_key'])) {
                $pid = $log['meta']['thread_key'];
                $httpClient->get("http://".DUOSHUO_NAME.".duoshuo.com/api/threads/listPosts.json?limit=1&page=1&thread_key={$pid}");
                $tmp = json_decode($httpClient->buffer, true);
                $comment = (int)$tmp['thread']['comments'];
                $fv->set($pid, $comments);
            }

            //更新last_log_id，记得维护last_log_id。（如update你的数据库）
            if (strlen($log['log_id']) > strlen($last_log_id) || strcmp($log['log_id'], $last_log_id) > 0) {
                $last_log_id = $log['log_id'];
                $fv->set("last_id", $last_log_id);
            }

        }


    }

}

function sync_log() {
    if (check_signature($_POST)) {
        get_update();
    }
}


function check_signature($input){

    $signature = $input['signature'];
    unset($input['signature']);

    ksort($input);
    $baseString = http_build_query($input, null, '&');
    $expectSignature = base64_encode(hmacsha1($baseString, DUOSHUO_SA));
    if ($signature !== $expectSignature) {
        return false;
    }
    return true;
}

// from: http://www.php.net/manual/en/function.sha1.php#39492
// Calculate HMAC-SHA1 according to RFC2104
// http://www.ietf.org/rfc/rfc2104.txt
function hmacsha1($data, $key) {
    if (function_exists('hash_hmac'))
        return hash_hmac('sha1', $data, $key, true);

    $blocksize=64;
    if (strlen($key)>$blocksize)
        $key=pack('H*', sha1($key));
    $key=str_pad($key,$blocksize,chr(0x00));
    $ipad=str_repeat(chr(0x36),$blocksize);
    $opad=str_repeat(chr(0x5c),$blocksize);
    $hmac = pack(
            'H*',sha1(
                    ($key^$opad).pack(
                            'H*',sha1(
                                    ($key^$ipad).$data
                            )
                    )
            )
    );
    return $hmac;
}
// get_update();
sync_log();
?>