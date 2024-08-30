<?php

namespace Belokdwi\Bpjs;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use phpDocumentor\Reflection\Types\This;

class BpjsService
{
    /**
     * Guzzle HTTP Client object
     * @var \GuzzleHttp\Client
     */
    private $clients;

    /**
     * Request headers
     * @var array
     */
    private $headers;

    /**
     * X-cons-id header value
     * @var int
     */
    private $cons_id;

    /**
     * X-Timestamp header value
     * @var string
     */
    private $timestamp;

    /**
     * X-Signature header value
     * @var string
     */
    private $signature;

    /**
     * X-Authorization header value
     * @var string
     */
    private $authorization;

    /**
     * @var string
     */
    private $secret_key;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $user_key;

    /**
     * @var string
     */
    private $app_code;

    /**
     * @var string
     */
    private $base_url;

    /**
     * @var string
     */
    private $service_name;

    /**
     * @var string
     */
    protected $feature;

    public function __construct($configurations = [])
    {
        $this->clients = new Client([
            'verify' => false
        ]);

        // merge configs
        $configurations = config('bpjs') + $configurations;

        foreach ($configurations as $key => $val) {
            if (property_exists($this, $key)) {
                $this->$key = $val;
            }
        }

        //set X-Timestamp, X-Signature, and finally the headers
        $this->setTimestamp()->setSignature()->setAuthorization()->setHeaders();
    }

    public function keyword($keyword)
    {
        $this->feature .= "/{$keyword}";
        return $this;
    }

    public function index($offset = null, $limit = null)
    {
        $feature = $this->feature;
        if ($offset !== null and $limit !== null) {
            $response = $this->get("{$feature}/{$offset}/{$limit}");
        } else {
            $response = $this->get("{$feature}");
        }
        return $this->decorateResponse($response);
    }

    public function show($keyword = null, $offset = null, $limit = null)
    {
        $feature = $this->feature;
        if ($offset !== null and $limit !== null) {
            $response = $this->get("{$feature}/{$keyword}/{$offset}/{$limit}");
        } elseif ($keyword !== null) {
            $response = $this->get("{$feature}/{$keyword}");
        } else {
            $response = $this->get("{$feature}");
        }
        return $this->decorateResponse($response);
    }

    public function store($data = [])
    {
        $response = $this->post($this->feature, $data);
        return $this->decorateResponse($response);
    }

    public function update($data = [])
    {
        $response = $this->put($this->feature, $data);
        return $this->decorateResponse($response);
    }

    public function destroy($keyword = null, $parameters = [])
    {
        $response = $this->delete($this->feature, $keyword, $parameters);
        return $this->decorateResponse($response);
    }

    protected function setHeaders()
    {
        $this->addHeader('X-cons-id', $this->cons_id);
        $this->addHeader('X-timestamp', $this->timestamp);
        $this->addHeader('X-signature', $this->signature);
        $this->addHeader('X-authorization', "Basic {$this->authorization}");
        $this->addHeader('user_key', $this->user_key);
        return $this;
    }

    protected function setTimestamp()
    {
        $dateTime = new \DateTime('now', new \DateTimeZone('UTC'));
        $this->timestamp = (string) $dateTime->getTimestamp();
        return $this;
    }

    protected function setSignature()
    {
        $data = "{$this->cons_id}&{$this->timestamp}";
        $signature = hash_hmac('sha256', $data, $this->secret_key, true);
        $encodedSignature = base64_encode($signature);
        $this->signature = $encodedSignature;
        return $this;
    }

    protected function setAuthorization()
    {
        $data = "{$this->username}:{$this->password}:{$this->app_code}";
        $encodedAuth = base64_encode($data);
        $this->authorization = $encodedAuth;
        return $this;
    }

    protected function setServiceName(string $serviceName)
    {
        $this->service_name = $serviceName;
        return $this;
    }

    protected function getClients()
    {
        return $this->clients;
    }

    protected function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
        return $this;
    }

    protected function getHeaders()
    {
        return $this->headers;
    }

    protected function getBaseUrl()
    {
        return $this->base_url;
    }

    protected function getServiceName()
    {
        return $this->service_name;
    }

    protected function get($feature, $parameters = [])
    {
        $params = $this->getParams($parameters);
        $this->addHeader('Content-Type', 'application/json; charset=utf-8');
        try {
            $response = $this->clients->request(
                'GET',
                "{$this->getBaseUrl()}/{$this->getServiceName()}/{$feature}{$params}",
                [
                    'headers' => $this->getHeaders()
                ]
            )->getBody()->getContents();
        } catch (\Exception $e) {
            $response = $this->decorateException($e);
        }
        return $response;
    }

    protected function post($feature, $data = [], $headers = [])
    {
        $this->addHeader('Content-Type', 'text/plain');
        $this->addHeader('Accept', 'application/json');
        if (!empty($headers)) {
            $this->headers = array_merge($this->headers, $headers);
        }
        try {
            $response = $this->clients->request(
                'POST',
                "{$this->getBaseUrl()}/{$this->getServiceName()}/{$feature}",
                [
                    'headers' => $this->getHeaders(),
                    'body' => json_encode($data),
                ]
            )->getBody()->getContents();
        } catch (\Exception $e) {
            $response = $this->decorateException($e);
        }
        return $response;
    }

    protected function put($feature, $data = [])
    {
        $this->addHeader('Content-Type', 'text/plain');
        $this->addHeader('Accept', 'application/json');
        try {
            $response = $this->clients->request(
                'PUT',
                "{$this->getBaseUrl()}/{$this->getServiceName()}/{$feature}",
                [
                    'headers' => $this->getHeaders(),
                    'body' => json_encode($data),
                ]
            )->getBody()->getContents();
        } catch (\Exception $e) {
            $response = $this->decorateException($e);
        }
        return $response;
    }

    protected function delete($feature, $id, $parameters = [])
    {
        $params = $this->getParams($parameters);
        $this->addHeader('Content-Type', 'application/json; charset=utf-8');
        $this->addHeader('Accept', 'application/json');
        $url = "{$this->getBaseUrl()}/{$this->getServiceName()}";
        if ($id !== null) {
            $url .= "/{$feature}/{$id}";
        } else {
            $url .= "/{$feature}";
        }
        try {
            $response = $this->clients->request(
                'DELETE',
                "{$url}{$params}",
                [
                    'headers' => $this->getHeaders(),
                ]
            )->getBody()->getContents();
        } catch (\Exception $e) {
            $response = $this->decorateException($e);
        }
        return $response;
    }

    private function getParams($parameters)
    {
        $params = '';
        foreach ($parameters as $key => $value) {
            if (is_int($key)) {
                $params .= "/{$value}";
            } else {
                $params .= "/{$key}/{$value}";
            }
        }
        return $params;
    }

    private function stringDecrypt($key, $string)
    {
        $encrypt_method = 'AES-256-CBC';

        // hash
        $key_hash = hex2bin(hash('sha256', $key));

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);

        return $output;
    }

    private function decompress($string)
    {
        return \LZCompressor\LZString::decompressFromEncodedURIComponent($string);
    }

    private function getKey()
    {
        return "{$this->cons_id}{$this->secret_key}{$this->timestamp}";
    }

    private function decorateResponse(string $response)
    {
        $response = json_decode($response, true);
        $value = $response['response'];
        if (!empty($value)) {
            $decrypted = $this->stringDecrypt($this->getKey(), $value);
            $decompressed = $this->decompress($decrypted);
            $response['response'] = json_decode($decompressed, true);
        }
        return $response;
    }

    private function decorateException($e)
    {
        $message = $e->getMessage();
        $code = $e->getCode();

        if ($e instanceof ClientException) {
            if ($e->hasResponse()) {
                $clientResponse = $e->getResponse();
                $message = $clientResponse->getReasonPhrase();
                $code = $clientResponse->getStatusCode();
                $body = $clientResponse->getBody();

                $content = json_decode($body->getContents());
                if ($content) {
                    $response = $content->response ?: null;
                    if (is_object($response)) {
                        $message = $response->message;
                    }
                }
            }
        }

        $result = json_encode([
            'response' => $message,
            'metaData' =>  [
                'message' => $message,
                'code' => $code ?: 400,
            ],
        ]);

        \Log::error($result . PHP_EOL . $e->getTraceAsString());

        return $result;
    }
}
