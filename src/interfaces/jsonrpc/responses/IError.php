<?php
namespace extas\interfaces\jsonrpc\responses;

use extas\interfaces\IItem;

/**
 * Interface IError
 *
 * @package extas\interfaces\jsonrpc\responses
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IError extends IItem
{
    public const SUBJECT = 'extas.http.jsonrpc.error';

    public const FIELD___CODE = 'code';
    public const FIELD___DATA = 'data';
    public const FIELD___MESSAGE = 'message';

    /**
     * @return int
     */
    public function getCode(): int;

    /**
     * @return array
     */
    public function getData(): array;

    /**
     * @return string
     */
    public function getMessage(): string;

    /**
     * @param int $code
     * @return IError
     */
    public function setCode(int $code): IError;

    /**
     * @param array $data
     * @return IError
     */
    public function setData(array $data): IError;

    /**
     * @param string $message
     * @return IError
     */
    public function setMessage(string $message): IError;
}
