<?php
namespace App\Foundation;

use ReflectionClass;

class Status
{

    /**
     * 
     */
    public const active = 'active';

    /**
     * 
     */
    public const canceled = 'canceled';

    /**
     * 
     */
    public const trialing = 'trialing';

    /**
     * 
     * @param string $status
     * @return string
     */
    public static function getStatusColor(string $status): string
    {
        return match ($status) {
            'active' => 'green-600',
            'canceled' => 'red-500',
            'trialing' => 'orange-500',
        };
    }
}
