<?php
namespace extas\interfaces\stages;

use extas\interfaces\http\IHasPsrResponse;
use extas\interfaces\jsonrpc\IResponse;

/**
 * Interface IStageHttpJsonRpcError
 *
 * @package extas\interfaces\stages
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IStageHttpJsonRpcError extends IHasPsrResponse
{
    public const NAME = 'extas.http.jsonrpc.error';

    /**
     * @param IResponse $response
     */
    public function __invoke(IResponse &$response): void;
}
