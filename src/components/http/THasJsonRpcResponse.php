<?php
namespace extas\components\http;

use extas\components\jsonrpc\Response;
use extas\components\Plugins;
use extas\interfaces\http\IHasPsrResponse;
use extas\interfaces\jsonrpc\IResponse;
use extas\interfaces\jsonrpc\responses\IError;
use extas\interfaces\stages\IStageHttpJsonRpcError;
use extas\interfaces\stages\IStageHttpJsonRpcSuccess;
use Psr\Http\Message\ResponseInterface;

/**
 * Trait THasJsonRpcResponse
 *
 * @package extas\components\http
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasJsonRpcResponse
{
    use THasPsrResponse;

    /**
     * @param string $id
     * @param $data
     * @return ResponseInterface
     */
    public function successResponse(string $id, $data): ResponseInterface
    {
        return $this->constructResponse(
            $id,
            [
                IResponse::FIELD__RESULT => $data
            ],
            IStageHttpJsonRpcSuccess::NAME
        );
    }

    /**
     * @param string $id
     * @param string $message
     * @param int $code
     * @param array $data
     * @return ResponseInterface
     */
    public function errorResponse(string $id, string $message, int $code, $data = []): ResponseInterface
    {
        return $this->constructResponse(
            $id,
            [
                IResponse::FIELD__ERROR => [
                    IError::FIELD___CODE => $code,
                    IError::FIELD___DATA => $data,
                    IError::FIELD___MESSAGE => $message
                ]
            ],
            IStageHttpJsonRpcError::NAME
        );
    }

    /**
     * @param string $id
     * @param array $jsonRpcResponseData
     * @param string $stage
     *
     * @return ResponseInterface
     */
    protected function constructResponse(string $id, array $jsonRpcResponseData, string $stage)
    {
        $jsonRpcResponseData[IResponse::FIELD__ID] = $id;
        $jsonRpcResponseData[IResponse::FIELD__VERSION] = IResponse::VERSION_CURRENT;

        $jsonRpcResponse = new Response($jsonRpcResponseData);
        $pluginConfig = [IHasPsrResponse::FIELD__PSR_RESPONSE => $this->getPsrResponse()];

        foreach (Plugins::byStage($stage, $this, $pluginConfig) as $plugin) {
            /**
             * @var IStageHttpJsonRpcError|IStageHttpJsonRpcSuccess $plugin
             */
            $plugin($jsonRpcResponse);
        }

        $response = new \Slim\Psr7\Response();
        $response = $response->withHeader('Content-type', 'application/json')->withStatus(200);
        $response->getBody()->write($jsonRpcResponse->__toJson());

        return $response;
    }
}
