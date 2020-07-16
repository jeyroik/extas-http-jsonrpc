<?php
namespace extas\components\http;

use extas\components\jsonrpc\Request;
use extas\interfaces\jsonrpc\IRequest;

/**
 * Trait THasJsonRpcRequest
 *
 * @package extas\components\http
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasJsonRpcRequest
{
    use THasPsrRequest;

    /**
     * @return IRequest
     */
    public function getJsonRpcRequest(): IRequest
    {
        return Request::fromHttp($this->getPsrRequest());
    }
}
