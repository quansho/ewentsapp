<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ApiController extends Controller
{

    public function toResponseWithStruct($result)
    {
        return ['error'=>session()->errors(), 'result'=>$result];
    }
}
