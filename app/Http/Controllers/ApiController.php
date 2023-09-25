<?php

namespace App\Http\Controllers;

class ApiController extends Controller
{

    public function toResponseWithStruct($result): array
    {
        return ['error'=>session()->get('errors'), 'result'=>$result];
    }
}
