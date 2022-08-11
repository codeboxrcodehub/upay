<?php

namespace Codeboxr\Upay\Exception;

use Exception;
use Throwable;

class UpayException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render()
    {
        return [
            'error'   => true,
            'code'    => $this->code,
            'message' => $this->getMessage(),
        ];
    }

}
