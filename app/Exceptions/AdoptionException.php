<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class AdoptionException extends Exception
{
    public static function catHasInvalidStatus(): self
    {
        return new self('You can only adopt cats with the status of "available"');
    }
}
