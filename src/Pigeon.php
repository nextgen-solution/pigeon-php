<?php

namespace NextGenSolution\Pigeon;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Pigeon
{
    /**
     * Pigeon host.
     *
     * @var string
     */
    protected $host = 'https://pigeon.mycard.in.th';

    /**
     * Pigeon token.
     *
     * @var string
     */
    protected $token;

    /**
     * Guzzle client instance.
     *
     * @var Client
     */
    protected $http;

    /**
     * Create a new instance.
     *
     * @param string $token
     * @param string $host
     */
    public function __construct(string $token, ?string $host = null)
    {
        $this->token = $token;
        $this->host = $host ?? $this->host;

        $this->setHttp(new Client([
            'base_uri' => $this->host,
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => "Bearer {$this->token}",
            ],
        ]));
    }

    /**
     * Send an email.
     *
     * @param string $recipient
     * @param string $subject
     * @param string $content
     * @param string $driver
     * @return array|null
     */
    public function sendMail(string $recipient, string $subject, string $content, ?string $driver = null): ?array
    {
        $url = '/api/send/mail';
        $json = array_filter(compact('recipient', 'subject', 'content', 'driver'));

        $response = $this->getHttp()->post($url, [
            'json' => $json,
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Send an email by template.
     *
     * @param string $recipient
     * @param string $template
     * @param array $params
     * @param string $driver
     * @return array|null
     */
    public function sendMailByTemplate(string $recipient, string $template, array $params = [], ?string $driver = null): ?array
    {
        $url = '/api/send/mail';
        $json = array_filter(compact('recipient', 'template', 'params', 'driver'));

        $response = $this->getHttp()->post($url, [
            'json' => $json,
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Send batch email.
     *
     * @param array $requests
     * @return array|null
     */
    public function sendBatchMail(array $requests): ?array
    {
        $url = '/api/send/mail/batch';

        $response = $this->getHttp()->post($url, [
            'json' => $requests,
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Send a text.
     *
     * @param string $recipient
     * @param string $content
     * @param string $driver
     * @return array|null
     */
    public function sendText(string $recipient, string $content, ?string $driver = null): ?array
    {
        $url = '/api/send/text';
        $json = array_filter(compact('recipient', 'content', 'driver'));

        $response = $this->getHttp()->post($url, [
            'json' => $json,
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Send a text by template.
     *
     * @param string $recipient
     * @param string $template
     * @param array $params
     * @param string $driver
     * @return array|null
     */
    public function sendTextByTemplate(string $recipient, string $template, array $params = [], ?string $driver = null): ?array
    {
        $url = '/api/send/text';
        $json = array_filter(compact('recipient', 'template', 'params', 'driver'));

        $response = $this->getHttp()->post($url, [
            'json' => $json,
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Send batch text.
     *
     * @param array $requests
     * @return array|null
     */
    public function sendBatchText(array $requests): ?array
    {
        $url = '/api/send/text/batch';

        $response = $this->getHttp()->post($url, [
            'json' => $requests,
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Send a notification.
     *
     * @param string $target
     * @param string $recipient
     * @param string $subject
     * @param string $content
     * @param array $options
     * @param string $driver
     * @return array|null
     */
    public function sendNotification(string $target, string $recipient, string $subject, string $content, array $options = [], ?string $driver = null): ?array
    {
        $url = '/api/send/notification';
        $json = array_filter(compact('target', 'recipient', 'subject', 'content', 'options', 'driver'));

        $response = $this->getHttp()->post($url, [
            'json' => $json,
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Send a notification by template.
     *
     * @param string $target
     * @param string $recipient
     * @param string $template
     * @param array $params
     * @param array $options
     * @param string $driver
     * @return array|null
     */
    public function sendNotificationByTemplate(string $target, string $recipient, string $template, array $params = [], array $options = [], ?string $driver = null): ?array
    {
        $url = '/api/send/notification';
        $json = array_filter(compact('target', 'recipient', 'template', 'params', 'options', 'driver'));

        $response = $this->getHttp()->post($url, [
            'json' => $json,
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Send batch notification.
     *
     * @param array $requests
     * @return array|null
     */
    public function sendBatchNotification(array $requests): ?array
    {
        $url = '/api/send/notification/batch';

        $response = $this->getHttp()->post($url, [
            'json' => $requests,
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Send OTP email.
     *
     * @param string $recipient
     * @param string|null $template
     * @param array $params
     * @param string|null $remark
     * @param string|null $driver
     * @return array|null
     */
    public function sendOTPViaMail(string $recipient, ?string $template = null, array $params = [], ?string $remark = null, ?string $driver = null): ?array
    {
        $url = '/api/otp/mail';
        $json = array_filter(compact('recipient', 'template', 'params', 'remark', 'driver'));

        $response = $this->getHttp()->post($url, [
            'json' => $json,
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Send OTP text.
     *
     * @param string $recipient
     * @param string|null $template
     * @param array $params
     * @param string|null $remark
     * @param string|null $driver
     * @return array|null
     */
    public function sendOTPViaText(string $recipient, ?string $template = null, array $params = [], ?string $remark = null, ?string $driver = null): ?array
    {
        $url = '/api/otp/text';
        $json = array_filter(compact('recipient', 'template', 'params', 'remark', 'driver'));

        $response = $this->getHttp()->post($url, [
            'json' => $json,
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Verify OTP
     *
     * @param string $recipient
     * @param string $otp
     * @param bool $strict
     * @param string $reference
     * @param string $remark
     * @return bool
     */
    public function verifyOTP(string $recipient, string $otp, bool $strict = false, ?string $reference = null, ?string $remark = null): bool
    {
        $url = '/api/otp/verify';
        $json = array_filter(compact('recipient', 'otp', 'strict', 'reference', 'remark'));

        try {
            $this->getHttp()->post($url, [
                'json' => $json,
            ]);

            return true;
        } catch (ClientException $e) {
            if ($e->hasResponse() && $e->getResponse()->getStatusCode() === 400) {
                return false;
            }

            throw $e;
        }
    }

    /**
     * @param \GuzzleHttp\Client $http
     * @return void
     */
    public function setHttp(Client $http): void
    {
        $this->http = $http;
    }

    /**
     * @return Client
     */
    public function getHttp(): Client
    {
        return $this->http;
    }
}
