<?php
namespace extas\interfaces\stages;

use extas\interfaces\http\IHasPsrResponse;
use extas\interfaces\jsonrpc\IResponse;

/**
 * Interface IStageHttpJsonRpcSuccess
 *
 * @package extas\interfaces\stages
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IStageHttpJsonRpcSuccess extends IHasPsrResponse
{
    public const NAME = 'extas.http.jsonrpc.success';

    /**
     * @param IResponse $response
     */
    public function __invoke(IResponse &$response): void;
}
