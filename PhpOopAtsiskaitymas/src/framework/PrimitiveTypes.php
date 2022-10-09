<?php

declare(strict_types=1);

namespace SimonasLinkis\PhpOopAtsiskaitymas\Framework;

class PrimitiveTypes
{

    /**
     * @param string $type Name of type (eg., App, string, bool, MyProject\Service)
     */
    public static function isPrimitive(string $type)
    {
        $primitiveTypes = ['int', 'float', 'string', 'bool', 'array', 'object'];
        return in_array($type, $primitiveTypes);
    }

}
