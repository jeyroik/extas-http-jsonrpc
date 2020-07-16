<?php
namespace extas\components\jsonrpc;

use extas\components\Item;
use extas\components\jsonrpc\responses\Error;
use extas\interfaces\jsonrpc\IResponse;
use extas\interfaces\jsonrpc\responses\IError;

/**
 * Class Response
 *
 * @package extas\components\jsonrpc
 * @author jeyroik <jeyroik@gmail.com>
 */
class Response extends Item implements IResponse
{
    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->config[static::FIELD__ID] ?? '';
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->config[static::FIELD__VERSION] ?? '';
    }

    /**
     * @return IError
     */
    public function getError(): IError
    {
        return new Error($this->config[static::FIELD__ERROR] ?? []);
    }

    /**
     * @param IError $error
     * @return $this|IResponse
     */
    public function setError(IError $error): IResponse
    {
        $this->config[static::FIELD__ERROR] = $error->__toArray();

        return $this;
    }

    /**
     * @param array $result
     * @return IResponse
     */
    public function setResult(array $result): IResponse
    {
        $this->config[static::FIELD__RESULT] = $result;

        return $this;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
