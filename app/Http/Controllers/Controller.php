<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    function check_api_token($api_token)
    {
        if ($api_token != null && $api_token != "") {
            return Employee::where("token", $api_token)->where("is_active", '1')->first();
        } else {
            return null;
        }
    }
}
