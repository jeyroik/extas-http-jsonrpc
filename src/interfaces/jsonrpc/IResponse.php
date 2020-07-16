<?php
namespace extas\interfaces\jsonrpc;

use extas\interfaces\IItem;
use extas\interfaces\jsonrpc\responses\IError;

/**
 * Interface IResponse
 *
 * @package extas\interfaces\jsonrpc
 * @author jeyroik@gmail.com
 */
interface IResponse extends IItem
{
    const SUBJECT = 'extas.http.jsonrpc.response';

    const FIELD__DATA = 'data';

    const FIELD__ID = 'id';
    const FIELD__VERSION = 'jsonrpc';
    const FIELD__RESULT = 'result';
    const FIELD__ERROR = 'error';

    const VERSION_CURRENT = '2.0';

    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getVersion(): string;

    /**
     * @return IError
     */
    public function getError(): IError;

    /**
     * @return array
     */
    public function getResult(): array;

    /**
     * @param IError $error
     * @return IResponse
     */
    public function setError(IError $error): IResponse;

    /**
     * @param array $result
     * @return IResponse
     */
    public function setResult(array $result): IResponse;
}
