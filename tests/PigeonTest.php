<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

use NextGenSolution\Pigeon\Pigeon;

class PigeonTest extends TestCase
{
    public function testCanCreateInstance(): void
    {
        $pigeon = new Pigeon('pigeon-token');

        $httpConfig = $pigeon->getHttp()->getConfig();

        $this->assertEquals('application/json', $httpConfig['headers']['Accept']);
        $this->assertEquals('Bearer pigeon-token', $httpConfig['headers']['Authorization']);
        $this->assertEquals('https://pigeon.mycard.in.th', (string) $httpConfig['base_uri']);
    }

    public function testCanCreateInstanceWithHost(): void
    {
        $pigeon = new Pigeon('pigeon-token-2', 'https://pigeon.ngs.bz');

        $httpConfig = $pigeon->getHttp()->getConfig();

        $this->assertEquals('application/json', $httpConfig['headers']['Accept']);
        $this->assertEquals('Bearer pigeon-token-2', $httpConfig['headers']['Authorization']);
        $this->assertEquals('https://pigeon.ngs.bz', (string) $httpConfig['base_uri']);
    }

    public function testSendMail(): void
    {
        $pigeon = new Pigeon('pigeon-token');
        $pigeon->setHttp(new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new Response(202, [], json_encode([
                    'message' => 'Accepted.',
                ])),
            ])),
        ]));

        $result = $pigeon->sendMail('example@email.com', 'Test subject', 'Test content');

        $this->assertArrayHasKey('message', $result);
    }

    public function testSendMailByTemplate(): void
    {
        $pigeon = new Pigeon('pigeon-token');
        $pigeon->setHttp(new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new Response(202, [], json_encode([
                    'message' => 'Accepted.',
                ])),
            ])),
        ]));

        $result = $pigeon->sendMailByTemplate('example@email.com', 'test_template');

        $this->assertArrayHasKey('message', $result);
    }

    public function testSendMailByTemplateWithParams(): void
    {
        $pigeon = new Pigeon('pigeon-token');
        $pigeon->setHttp(new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new Response(202, [], json_encode([
                    'message' => 'Accepted.',
                ])),
            ])),
        ]));

        $result = $pigeon->sendMailByTemplate('example@email.com', 'test_template_with_params', ['name' => 'Bob']);

        $this->assertArrayHasKey('message', $result);
    }

    public function testSendBatchMail(): void
    {
        $pigeon = new Pigeon('pigeon-token');
        $pigeon->setHttp(new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new Response(202, [], json_encode([
                    'message' => 'Accepted.',
                ])),
            ])),
        ]));

        $result = $pigeon->sendBatchMail([
            [
                'recipient' => 'bob@example.com',
                'template' => 'test_batch',
                'params' => [
                    'batch' => '1',
                    'name' => 'One',
                ],
            ],
            [
                'recipient' => 'alice@example.com',
                'template' => 'test_batch',
                'params' => [
                    'batch' => '2',
                    'name' => 'Two',
                ],
            ],
        ]);

        $this->assertArrayHasKey('message', $result);
    }

    public function testSendText(): void
    {
        $pigeon = new Pigeon('pigeon-token');
        $pigeon->setHttp(new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new Response(202, [], json_encode([
                    'message' => 'Accepted.',
                ])),
            ])),
        ]));

        $result = $pigeon->sendText('0888888888', 'Test content');

        $this->assertArrayHasKey('message', $result);
    }

    public function testSendTextByTemplate(): void
    {
        $pigeon = new Pigeon('pigeon-token');
        $pigeon->setHttp(new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new Response(202, [], json_encode([
                    'message' => 'Accepted.',
                ])),
            ])),
        ]));

        $result = $pigeon->sendTextByTemplate('0888888888', 'test_template');

        $this->assertArrayHasKey('message', $result);
    }

    public function testSendTextByTemplateWithParams(): void
    {
        $pigeon = new Pigeon('pigeon-token');
        $pigeon->setHttp(new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new Response(202, [], json_encode([
                    'message' => 'Accepted.',
                ])),
            ])),
        ]));

        $result = $pigeon->sendTextByTemplate('0888888888', 'test_template_with_params', ['name' => 'Bob']);

        $this->assertArrayHasKey('message', $result);
    }

    public function testSendBatchText(): void
    {
        $pigeon = new Pigeon('pigeon-token');
        $pigeon->setHttp(new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new Response(202, [], json_encode([
                    'message' => 'Accepted.',
                ])),
            ])),
        ]));

        $result = $pigeon->sendBatchMail([
            [
                'recipient' => '0888888888',
                'template' => 'test_batch',
                'params' => [
                    'batch' => '1',
                    'name' => 'One',
                ],
            ],
            [
                'recipient' => '0999999999',
                'template' => 'test_batch',
                'params' => [
                    'batch' => '2',
                    'name' => 'Two',
                ],
            ],
        ]);

        $this->assertArrayHasKey('message', $result);
    }

    public function testSendNotification(): void
    {
        $pigeon = new Pigeon('pigeon-token');
        $pigeon->setHttp(new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new Response(202, [], json_encode([
                    'message' => 'Accepted.',
                ])),
            ])),
        ]));

        $result = $pigeon->sendNotification('token', 'device-token', 'Test subject', 'Test content');

        $this->assertArrayHasKey('message', $result);
    }

    public function testSendNotificationByTemplate(): void
    {
        $pigeon = new Pigeon('pigeon-token');
        $pigeon->setHttp(new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new Response(202, [], json_encode([
                    'message' => 'Accepted.',
                ])),
            ])),
        ]));

        $result = $pigeon->sendNotificationByTemplate('token', 'device-token', 'test_template');

        $this->assertArrayHasKey('message', $result);
    }

    public function testSendNotificationByTemplateWithParams(): void
    {
        $pigeon = new Pigeon('pigeon-token');
        $pigeon->setHttp(new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new Response(202, [], json_encode([
                    'message' => 'Accepted.',
                ])),
            ])),
        ]));

        $result = $pigeon->sendNotificationByTemplate('token', 'device-token', 'test_template_with_params', ['name' => 'Bob']);

        $this->assertArrayHasKey('message', $result);
    }

    public function testSendBatchNotification(): void
    {
        $pigeon = new Pigeon('pigeon-token');
        $pigeon->setHttp(new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new Response(202, [], json_encode([
                    'message' => 'Accepted.',
                ])),
            ])),
        ]));

        $result = $pigeon->sendBatchNotification([
            [
                'target' => 'token',
                'recipient' => 'device-token-1',
                'template' => 'test_batch',
                'params' => [
                    'batch' => '1',
                    'name' => 'One',
                ],
            ],
            [
                'target' => 'token',
                'recipient' => 'device-token-2',
                'template' => 'test_batch',
                'params' => [
                    'batch' => '2',
                    'name' => 'Two',
                ],
            ],
        ]);

        $this->assertArrayHasKey('message', $result);
    }

    public function testSendOTPViaMail(): void
    {
        $pigeon = new Pigeon('pigeon-token');
        $pigeon->setHttp(new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new Response(202, [], json_encode([
                    'data' => [
                        'recipient' => 'example@email.com',
                        'reference' => 'ABCD',
                        'remark' => 'FOR_UNITTEST',
                    ],
                ])),
            ])),
        ]));

        $result = $pigeon->sendOTPViaMail('example@email.com', 'test_otp', ['name' => 'alice'], 'FOR_UNITTEST');

        $this->assertArrayHasKey('data', $result);

        $data = $result['data'];

        $this->assertArrayHasKey('reference', $data);
        $this->assertEquals('example@email.com', $data['recipient']);
        $this->assertEquals('FOR_UNITTEST', $data['remark']);
    }

    public function testSendOTPViaText(): void
    {
        $pigeon = new Pigeon('pigeon-token');
        $pigeon->setHttp(new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new Response(202, [], json_encode([
                    'data' => [
                        'recipient' => '0888888888',
                        'reference' => 'ABCD',
                        'remark' => 'FOR_UNITTEST',
                    ],
                ])),
            ])),
        ]));

        $result = $pigeon->sendOTPViaText('0888888888', 'test_otp', ['name' => 'alice'], 'FOR_UNITTEST');

        $this->assertArrayHasKey('data', $result);

        $data = $result['data'];

        $this->assertArrayHasKey('reference', $data);
        $this->assertEquals('0888888888', $data['recipient']);
        $this->assertEquals('FOR_UNITTEST', $data['remark']);
    }

    public function testVerifyOTPSuccess(): void
    {
        $pigeon = new Pigeon('pigeon-token');
        $pigeon->setHttp(new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new Response(202, [], json_encode([
                    'message' => 'Your OTP is valid.',
                ])),
            ])),
        ]));

        $result = $pigeon->verifyOTP('0888888888', '123456');

        $this->assertTrue($result);
    }

    public function testVerifyOTPStrictModeSuccess(): void
    {
        $pigeon = new Pigeon('pigeon-token');
        $pigeon->setHttp(new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new Response(202, [], json_encode([
                    'message' => 'Your OTP is valid.',
                ])),
            ])),
        ]));

        $result = $pigeon->verifyOTP('0888888888', '123456', true, 'ABCD', 'FOR_UNITTEST');

        $this->assertTrue($result);
    }

    public function testVerifyOTPFail(): void
    {
        $pigeon = new Pigeon('pigeon-token');
        $pigeon->setHttp(new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new ClientException('Bad Request', new Request('GET', 'test'), new Response(400, [], json_encode([
                    'message' => 'Your OTP is invalid or expired.',
                ]))),
            ])),
        ]));

        $result = $pigeon->verifyOTP('0888888888', '123456');

        $this->assertFalse($result);
    }

    public function testVerifyOTPStrictModeFail(): void
    {
        $pigeon = new Pigeon('pigeon-token');
        $pigeon->setHttp(new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new ClientException('Bad Request', new Request('GET', 'test'), new Response(400, [], json_encode([
                    'message' => 'Your OTP is invalid or expired.',
                ]))),
            ])),
        ]));

        $result = $pigeon->verifyOTP('0888888888', '123456', true, 'QWER', 'FOR_UNITTEST_FAIL');

        $this->assertFalse($result);
    }
}
