<?php
namespace tests\jsonrpc;

use extas\components\http\THasJsonRpcRequest;
use extas\components\http\THasJsonRpcResponse;
use extas\components\http\TSnuffHttp;
use extas\components\Item;
use extas\interfaces\http\IHasJsonRpcRequest;
use extas\interfaces\http\IHasJsonRpcResponse;
use extas\interfaces\jsonrpc\IRequest;
use extas\interfaces\jsonrpc\IResponse;
use PHPUnit\Framework\TestCase;

/**
 * Class TraitsTest
 *
 * @package tests\jsonrpc
 * @author jeyroik <jeyroik@gmail.com>
 */
class TraitsTest extends TestCase
{
    use TSnuffHttp;

    public function testHasJsonRpcRequest()
    {
        $item = new class ([
            IHasJsonRpcRequest::FIELD__PSR_REQUEST => $this->getPsrRequest('')
        ]) extends Item {
            use THasJsonRpcRequest;

            protected function getSubjectForExtension(): string
            {
                return '';
            }
        };

        $request = $item->getJsonRpcRequest();
        $this->assertInstanceOf(IRequest::class, $request);
    }

    public function testHasJsonRpcResponse()
    {
        $item = new class ([
            IHasJsonRpcResponse::FIELD__PSR_RESPONSE => $this->getPsrResponse()
        ]) extends Item {
            use THasJsonRpcResponse;

            protected function getSubjectForExtension(): string
            {
                return '';
            }
        };

        $response = $this->getJsonRpcResponse($item->successResponse('id', ['test' => 'is ok']));
        $this->assertEquals(
            [
                IResponse::RESPONSE__ID => 'id',
                IResponse::RESPONSE__VERSION => IResponse::VERSION_CURRENT,
                IResponse::RESPONSE__RESULT => ['test' => 'is ok']
            ],
            $response
        );

        $response = $this->getJsonRpcResponse($item->errorResponse('id', 'test', 400, ['is ok']));
        $this->assertEquals(
            [
                IResponse::RESPONSE__ID => 'id',
                IResponse::RESPONSE__VERSION => IResponse::VERSION_CURRENT,
                IResponse::RESPONSE__ERROR => [
                    IResponse::RESPONSE__ERROR_CODE => 400,
                    IResponse::RESPONSE__ERROR_DATA => ['is ok'],
                    IResponse::RESPONSE__ERROR_MESSAGE => 'test'
                ]
            ],
            $response
        );
    }
}
