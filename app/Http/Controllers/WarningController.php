<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warning;

class WarningController extends \Illuminate\Routing\Controller
{
    public function index()
    {
        return response()->json(Warning::all());
    }

    public function show($id)
    {
        return response()->json(Warning::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $record = Warning::find($id);

        if ($record) {
            $record->update($request->all());
            return response()->json($record);
        } else {
            return response()->json(['message' => 'Warning not found'], 404);
        }
    }

}
