<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CursosMoodleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
