<?php

namespace Alibaba;
class Client
{
    private $appKey;

    private $appSecret;

    private $redirectUri;

    private $gateway = 'https://gw.open.1688.com/openapi/';

    public function __construct($clientId, $clientSecret, $redirectUri)
    {
        $this->appKey = $clientId;
        $this->appSecret = $clientSecret;
        $this->redirectUri = $redirectUri;
    }

    public function getAuthUrl($param = [], $state = '')
    {
        $state = $state ?: mt_rand(10000, 99999);
        $param = array_merge($param, [
            'client_id' => $this->appKey,
            'site' => 1688,
            'redirect_uri' => $this->redirectUri,
            'state' => $state,
        ]);
        return 'https://auth.1688.com/oauth/authorize?' . http_build_query($param);
    }

    public function getAccessTokenByCode($code)
    {
        $path = 'http/1/system.oauth2/getToken/' . $this->appKey . '?';
        $path .= http_build_query([
            'grant_type' => 'authorization_code',
            'need_refresh_token' => 'true',
            'client_id' => $this->appKey,
            'client_secret' => $this->appSecret,
            'redirect_uri' => $this->redirectUri,
            'code' => $code
        ]);
        return $this->curl($this->gateway . $path);
    }

    public function getAccessTokenByfreshToken($refresh_token)
    {
        $path = 'param2/1/system.oauth2/getToken/' . $this->appKey . '?';
        $path .= http_build_query([
            'grant_type' => 'refresh_token',
            'client_id' => $this->appKey,
            'client_secret' => $this->appSecret,
            'refresh_token' => $refresh_token,
        ]);
        return $this->curl($path);
    }

    private function getSign($path, $param)
    {
        $appSecret = $this->appSecret;
        $aliParams = array();
        foreach ($param as $key => $val) {
            $aliParams[] = $key . $val;
        }
        sort($aliParams);
        $sign_str = implode('', $aliParams);
        $sign_str = $path . $sign_str;
        return strtoupper(bin2hex(hash_hmac("sha1", $sign_str, $appSecret, true)));
    }

    private function curl($url, $query = [], $body = [], $method = 'GET', $headers = [])
    {
        $curl = curl_init();
        $opt = [
            CURLOPT_URL => $query ? $url . '?' . http_build_query($query) : $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => strtoupper($method),
        ];
        if ($headers) {
            $opt[CURLOPT_HTTPHEADER] = $headers;
        }
        if ($body) {
            $opt[CURLOPT_POSTFIELDS] = $body;
        }

        curl_setopt_array($curl, $opt);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}