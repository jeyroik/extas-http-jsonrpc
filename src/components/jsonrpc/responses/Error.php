<?php
namespace extas\components\jsonrpc\responses;

use extas\components\Item;
use extas\interfaces\jsonrpc\responses\IError;

/**
 * Class Error
 *
 * @package extas\components\jsonrpc\responses
 * @author jeyroik <jeyroik@gmail.com>
 */
class Error extends Item implements IError
{
    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->config[static::FIELD___CODE] ?? 0;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->config[static::FIELD___DATA] ?? [];
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->config[static::FIELD___MESSAGE] ?? '';
    }

    /**
     * @param int $code
     * @return $this|IError
     */
    public function setCode(int $code): IError
    {
        $this->config[static::FIELD___CODE] = $code;

        return $this;
    }

    /**
     * @param array $data
     * @return $this|IError
     */
    public function setData(array $data): IError
    {
        $this->config[static::FIELD___DATA] = $data;

        return $this;
    }

    /**
     * @param string $message
     * @return $this|IError
     */
    public function setMessage(string $message): IError
    {
        $this->config[static::FIELD___MESSAGE] = $message;

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
