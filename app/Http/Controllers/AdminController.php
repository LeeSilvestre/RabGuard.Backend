<?php

namespace App\Http\Controllers;

use App\Models\Admin; 
use Illuminate\Http\Request; 

class AdminController extends \Illuminate\Routing\Controller
{
    // Get all admin records
    public function getAllAdmins()
    {
        try {
            $admins = Admin::all();
            return response()->json($admins, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
