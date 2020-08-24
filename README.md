![tests](https://github.com/jeyroik/extas-http-jsonrpc/workflows/PHP%20Composer/badge.svg?branch=master&event=push)
![codecov.io](https://codecov.io/gh/jeyroik/extas-http-jsonrpc/coverage.svg?branch=master)
<a href="https://github.com/phpstan/phpstan"><img src="https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat" alt="PHPStan Enabled"></a> 
<a href="https://codeclimate.com/github/jeyroik/extas-http-jsonrpc/maintainability"><img src="https://api.codeclimate.com/v1/badges/da77767c1e927742e344/maintainability" /></a>
<a href="https://github.com/jeyroik/extas-installer/" title="Extas Installer v3"><img alt="Extas Installer v3" src="https://img.shields.io/badge/installer-v3-green"></a>
[![Latest Stable Version](https://poser.pugx.org/jeyroik/extas-http-jsonrpc/v)](//packagist.org/packages/jeyroik/extas-jsonrpc)
[![Total Downloads](https://poser.pugx.org/jeyroik/extas-http-jsonrpc/downloads)](//packagist.org/packages/jeyroik/extas-jsonrpc)
[![Dependents](https://poser.pugx.org/jeyroik/extas-http-jsonrpc/dependents)](//packagist.org/packages/jeyroik/extas-jsonrpc)

# Описание

Пакет содержит базовые модели для работы с JSON RPC.

# Использование

```php
use extas\interfaces\http\IHasJsonRpcRequest;
use extas\components\Item;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use extas\interfaces\http\IHasJsonRpcResponse;
use extas\components\http\THasJsonRpcRequest;
use extas\components\http\THasJsonRpcResponse;

/**
 * @var RequestInterface $request
 * @var ResponseInterface $response
 */

$item = new class ([
    IHasJsonRpcRequest::FIELD__PSR_REQUEST => $request,
    IHasJsonRpcResponse::FIELD__PSR_RESPONSE => $response
]) extends Item {
    use THasJsonRpcResponse;
    use THasJsonRpcRequest;
    
    protected function getSubjectForExtension() : string{
        return 'test';
    }
};

print_r(
    $item->successResponse(
        $item->getJsonRpcRequest()->getId(),
        [
            //some data
        ]
    )
);
```