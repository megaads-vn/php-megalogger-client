<?php

namespace MegaLogger;

use Emarref\Jwt\Claim;

class Logger {

    private $apiKey;
    private $source;

    public function __construct($initData) {
        self::_setApiKey($initData['apiKey']);
        self::_setSource($initData['source']);
    }

    public function pushLog($level = null, $data = []) {
        $token = self::_generateToken();
        $retVal = array(
            'status' => 'failed',
        );
        try {
            if ($level != null) {
                $time = time();
                $ip = self::_http()->getClientIp();
                $device = self::_http()->getUserAgent();

                $metaData = array(
                    'language' => 'PHP',
                    'ip' => $ip,
                    'device' => $device
                );

                $params = array(
                    'type' => 'request',
                    'token' => $token,
                    'level' => $level,
                    'time' => $time,
                    'source' => $this->source,
                    'data' => $data,
                    'meta' => $metaData
                );
                $strParams = json_encode($params);
                $output = self::_http()->curlExec($strParams);
                $retVal['status'] = 'ok';
                $retVal['response'] = $output;
            }
        } catch (Exception $ex) {
            $retVal['message'] = $ex->getMessage();
        }
        return $retVal;
    }

    private function _setApiKey($apiKey) {
        $this->apiKey = $apiKey;
    }

    private function _setSource($source) {
        $this->source = $source;
    }

    private function _generateToken() {
        $token = new \Emarref\Jwt\Token();
        $token->addClaim(new Claim\Audience($this->apiKey));
        $token->addClaim(new Claim\Expiration(new \DateTime('30 seconds')));
        $jwt = new \Emarref\Jwt\Jwt();
        $algorithm = new \Emarref\Jwt\Algorithm\HS512('megalogger');
        $encryption = \Emarref\Jwt\Encryption\Factory::create($algorithm);
        $serializedToken = $jwt->serialize($token, $encryption);
        return $serializedToken;
    }

    private static function _http() {
        return new \MegaLogger\Http\Http();
    }

}
