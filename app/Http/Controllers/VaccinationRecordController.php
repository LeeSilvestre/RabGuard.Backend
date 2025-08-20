<?php

namespace App\Http\Controllers;

use App\Models\VaccinationRecord;
use Illuminate\Http\Request;

class VaccinationRecordController extends \Illuminate\Routing\Controller
{
    public function index()
    {
        $records = VaccinationRecord::all();
        return response()->json($records);
    }

    public function show($id)
    {
        $record = VaccinationRecord::find($id);
        if ($record) {
            return response()->json($record);
        } else {
            return response()->json(['message' => 'Record not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'expdate' => 'required|date',
            'expplace' => 'required|string',
            'exptype' => 'required|string|in:Bite,Non-Bite',
            'expsource' => 'required|string',
        ]);

        $record = VaccinationRecord::create($request->all());
        return response()->json($record, 201);
    }

    public function update(Request $request, $id)
    {
        $record = VaccinationRecord::find($id);

        if ($record) {
            $record->update($request->all());
            return response()->json($record);
        } else {
            return response()->json(['message' => 'Record not found'], 404);
        }
    }

    public function destroy($id)
    {
        $record = VaccinationRecord::find($id);

        if ($record) {
            $record->delete();
            return response()->json(['message' => 'Record deleted successfully']);
        } else {
            return response()->json(['message' => 'Record not found'], 404);
        }
    }

    public function updateExpcateg(Request $request, $id)
    {
        $record = VaccinationRecord::find($id);

        if ($record) {
            $record->expcateg = $request->input('expcateg');
            $record->save();
            return response()->json($record);
        } else {
            return response()->json(['message' => 'Record not found'], 404);
        }
    }

    public function updateStatus($id)
    {
        $record = VaccinationRecord::find($id);

        if ($record) {
            $record->status = 2;
            $record->save();
            return response()->json($record);
        } else {
            return response()->json(['message' => 'Record not found'], 404);
        }
    }

    public function returnStatus($id)
    {
        $record = VaccinationRecord::find($id);

        if ($record) {
            $record->status = 3;
            $record->save();
            return response()->json($record);
        } else {
            return response()->json(['message' => 'Record not found'], 404);
        }
    }

    public function oldStatus($id)
    {
        $record = VaccinationRecord::find($id);

        if ($record) {
            $record->status = 5;
            $record->save();
            return response()->json($record);
        } else {
            return response()->json(['message' => 'Record not found'], 404);
        }
    }

    public function boostStatus($id)
    {
        $record = VaccinationRecord::find($id);

        if ($record) {
            $record->status = 4;
            $record->save();
            return response()->json($record);
        } else {
            return response()->json(['message' => 'Record not found'], 404);
        }
    }
}
