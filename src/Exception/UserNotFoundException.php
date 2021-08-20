<?php

declare(strict_types=1);

namespace App\Exception;

final class UserNotFoundException extends \RuntimeException
{
    public function __construct($message = 'User not found', $code = 404, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
