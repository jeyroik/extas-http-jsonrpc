<?php
namespace tests\jsonrpc;

use Dotenv\Dotenv;
use extas\components\jsonrpc\Response;
use extas\components\jsonrpc\responses\Error;
use extas\interfaces\jsonrpc\responses\IError;
use PHPUnit\Framework\TestCase;

/**
 * Class ResponseTest
 *
 * @package tests\jsonrpc
 * @author jeyroik <jeyroik@gmail.com>
 */
class ResponseTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
    }

    public function testBasicMethods()
    {
        $response = new Response([
            Response::FIELD__ID => 'id',
            Response::FIELD__VERSION => 'version',
            Response::FIELD__ERROR => [
                Error::FIELD___CODE => 400,
                Error::FIELD___MESSAGE => 'test',
                Error::FIELD___DATA => ['is ok']
            ],
            Response::FIELD__RESULT => [
                'test' => 'is ok'
            ]
        ]);

        $this->assertEquals('id', $response->getId());
        $this->assertEquals('version', $response->getVersion());
        $this->assertEquals(['test' => 'is ok'], $response->getResult());
        $this->assertInstanceOf(IError::class, $response->getError());
        $this->assertEquals(400, $response->getError()->getCode());
        $this->assertEquals('test', $response->getError()->getMessage());
        $this->assertEquals(['is ok'], $response->getError()->getData());
    }
}
