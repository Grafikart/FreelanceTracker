<?php

namespace App\Http\Controllers;

use App\Models\User;

abstract class Controller
{
    public function user(): User
    {
        return request()->user();
    }
}
