<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Code;

class CodeController extends Controller
{
    public function getAllCode(Request $request) 
    {
        $query = $request->query();
        $codes = Code::where('type', $query['key'])->get();

        return response()->json([
            'errCode' => 0,
            'message' => 'success',
            'codes' => $codes
        ]);
    }
}
