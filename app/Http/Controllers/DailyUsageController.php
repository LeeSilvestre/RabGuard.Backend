<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyUsage;

class DailyUsageController extends \Illuminate\Routing\Controller
{
    public function index()
    {
        return response()->json(DailyUsage::all());
    }

    public function show($id)
    {
        return response()->json(DailyUsage::findOrFail($id));
    }

}
