<?php

use App\Foundation\Status;

if (!function_exists('statusColor')) {
    function statusColor($status)
    {
        return Status::getStatusColor($status);
    }
}
