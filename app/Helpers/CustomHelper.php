<?php

if (!function_exists('allowedAccountStatusForLogin')) {
    function allowedAccountStatusForLogin()
    {
        return ["ACTIVE", "PENDING"];
    }
}
