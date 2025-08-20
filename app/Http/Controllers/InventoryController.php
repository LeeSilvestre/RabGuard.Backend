<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends \Illuminate\Routing\Controller
{
    public function index()
    {
        return response()->json(Inventory::all());
    }

    public function show($vaccine_id)
    {
        return response()->json(Inventory::findOrFail($vaccine_id));
    }

    public function store(Request $request)
    {
        $inventory = Inventory::create($request->all());
        return response()->json(['message' => 'Inventory added successfully!', 'inventory' => $inventory], 201);
    }

    public function update(Request $request, $vaccine_id)
    {
        $inventory = Inventory::find($vaccine_id);
        if ($inventory) {
            $inventory->hand_stocks = $request->input('hand_stocks');
            $inventory->save();
            return response()->json(['message' => 'Inventory updated successfully!']);
        } else {
            return response()->json(['message' => 'Inventory not found!'], 404);
        }
    }
    public function useStock($vaccine_id)
    {
        $inventory = Inventory::findOrFail($vaccine_id);
        
        if ($inventory->hand_stocks > 0) {
            $inventory->hand_stocks -= 0.5;
            $inventory->halfed = ($inventory->hand_stocks - floor($inventory->hand_stocks) == 0.5) ? 1 : 0;
            $inventory->save();
        }
        
        return response()->json(['message' => 'Stock decreased successfully', 'inventory' => $inventory]);
    }

    public function decreaseStock(Request $request, $vaccine_id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.1' // Ensure valid stock reduction amount
        ]);

        $amount = $request->input('amount');
        $inventory = Inventory::findOrFail($vaccine_id);

        if ($inventory->hand_stocks < $amount) {
            return response()->json(['error' => 'Not enough stock available'], 400);
        }

        // Deduct from hand_stocks and add to used_today
        $inventory->hand_stocks -= $amount;
        $inventory->used_today += $amount;
        
        // Check if hand_stocks has a decimal of .5
        $inventory->halfed = ($inventory->hand_stocks - floor($inventory->hand_stocks) == 0.5) ? 1 : 0;
        
        $inventory->save();

        return response()->json([
            'message' => 'Stock decreased successfully',
            'inventory' => $inventory
        ]);
    }

}
