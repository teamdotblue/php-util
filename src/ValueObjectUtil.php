<?php

declare(strict_types=1);

namespace TeamBlue\Util;

use function is_a;
use function is_object;
use function method_exists;

final class ValueObjectUtil
{
    public static function toScalar(mixed $data): mixed
    {
        if (
            is_object($data)
            && is_a($data, 'TeamBlue\ValueObjects\ValueObject')
            && method_exists($data, 'toValue')
        ) {
            return $data->toValue(); // @phpstan-ignore-line
        }

        return null;
    }
}
