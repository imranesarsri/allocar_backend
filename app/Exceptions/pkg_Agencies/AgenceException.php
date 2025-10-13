<?php

namespace App\Exceptions\pkg_Agencies;

use App\Exceptions\BusinessException;

class AgenceException extends BusinessException
{
    public static function getAllDataLogError()
    {
        return new self(__('pkg_Agencies/Error_retrieving_all_agnecies'));
    }
}