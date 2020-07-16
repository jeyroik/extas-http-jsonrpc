<?php
namespace extas\interfaces\http;

use extas\interfaces\jsonrpc\IRequest;

/**
 * Interface IHasJsonRpcRequest
 *
 * @package extas\interfaces\http
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasJsonRpcRequest extends IHasPsrRequest
{
    /**
     * @return IRequest
     */
    public function getJsonRpcRequest(): IRequest;
}
