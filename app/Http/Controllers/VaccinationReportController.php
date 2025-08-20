<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VaccinationRecord;
use App\Models\User;
use Carbon\Carbon;

class VaccinationReportController extends \Illuminate\Routing\Controller
{
    public function getYearlyVaccinationReport()
    {
        // Get all vaccination records for the given expplaces
        $vaccinationRecords = VaccinationRecord::whereIn('expplace', [
            'Asinan', 'Banicain', 'Barretto', 'New Cabalan', 'Old Cabalan', 'East Bajac-Bajac',
            'East Tapinac', 'Gordon Heights', 'New Ilalim', 'New Kababae', 'Kalaklan', 'New Kalalake',
            'Mabayuan', 'Pag-Asa', 'Sta. Rita', 'West Bajac-Bajac', 'West Tapinac', 'Others'
        ])->get();

        // Get all users
        $users = User::all();
        
        // Initialize the result array
        $results = [];
        
        // Loop through each expplace and calculate totals
        foreach (['Asinan', 'Banicain', 'Barretto', 'New Cabalan', 'Old Cabalan', 'East Bajac-Bajac',
                 'East Tapinac', 'Gordon Heights', 'New Ilalim', 'New Kababae', 'Kalaklan', 'New Kalalake',
                 'Mabayuan', 'Pag-Asa', 'Sta. Rita', 'West Bajac-Bajac', 'West Tapinac', 'Others'] as $expplace) {
            
            // Filter the vaccination records by expplace
            $filteredRecords = $vaccinationRecords->where('expplace', $expplace);
            
            // Count males and females
            $maleCount = $filteredRecords->filter(function ($record) use ($users) {
                return $users->where('user_id', $record->user_id)->first()->sex === 'male';
            })->count();
            
            $femaleCount = $filteredRecords->filter(function ($record) use ($users) {
                return $users->where('user_id', $record->user_id)->first()->sex === 'female';
            })->count();
            
            // Count ages under 15 and 15 and above
            $ageUnder15Count = $filteredRecords->filter(function ($record) use ($users) {
                $user = $users->where('user_id', $record->user_id)->first();
                $birthdate = \Carbon\Carbon::parse($user->birthdate); // Ensure it's a Carbon instance
                $age = now()->year - $birthdate->year; // Now, you can safely access 'year' property
                return $age < 15;
            })->count();
            
            $age15AndAboveCount = $filteredRecords->filter(function ($record) use ($users) {
                $user = $users->where('user_id', $record->user_id)->first();
                $birthdate = \Carbon\Carbon::parse($user->birthdate); // Ensure it's a Carbon instance
                $age = now()->year - $birthdate->year; // Now, you can safely access 'year' property
                return $age >= 15;
            })->count();
            
            // Count expcateg = 1, 2, and 3
            $expcateg1Count = $filteredRecords->where('expcateg', '1')->count();
            $expcateg2Count = $filteredRecords->where('expcateg', '2')->count();
            $expcateg3Count = $filteredRecords->where('expcateg', '3')->count();
            
            // Count booster = 1
            $boosterCount = $filteredRecords->where('booster', 1)->count();
            
            // Count expsource = Cat, Dog, Others
            $expsourceCatCount = $filteredRecords->where('expsource', 'Cat')->count();
            $expsourceDogCount = $filteredRecords->where('expsource', 'Dog')->count();
            $expsourceOthersCount = $filteredRecords->where('expsource', 'Others')->count();
            
            // Count wash = 0 and 1
            $wash0Count = $filteredRecords->where('wash', 0)->count();
            $wash1Count = $filteredRecords->where('wash', 1)->count();

            // Check if there are any records and get the year from the first record's expdate
            $year = null;
            if ($filteredRecords->isNotEmpty()) {
                $year = Carbon::parse($filteredRecords->first()->expdate)->year;
            }
            
            // Prepare the results for this expplace
            $results[] = [
                'expplace' => $expplace,
                'year' => $year,
                'total_records' => $filteredRecords->count(),
                'male_count' => $maleCount,
                'female_count' => $femaleCount,
                'age_under_15_count' => $ageUnder15Count,
                'age_15_and_above_count' => $age15AndAboveCount,
                'expcateg_1_count' => $expcateg1Count,
                'expcateg_2_count' => $expcateg2Count,
                'expcateg_3_count' => $expcateg3Count,
                'booster_count' => $boosterCount,
                'expsource_cat_count' => $expsourceCatCount,
                'expsource_dog_count' => $expsourceDogCount,
                'expsource_others_count' => $expsourceOthersCount,
                'wash_0_count' => $wash0Count,
                'wash_1_count' => $wash1Count
            ];
        }

        // Return the results as JSON
        return response()->json($results);
    }
    public function getFilteredRecords(Request $request)
    {
        $query = VaccinationRecord::query();

        if ($request->has('year')) {
            $query->whereYear('created_at', $request->year);
        }
        if ($request->has('expplace')) {
            $query->where('expplace', $request->expplace);
        }
        if ($request->has('expcateg')) {
            $query->where('expcateg', $request->expcateg);
        }
        if ($request->has('booster')) {
            $query->where('booster', $request->booster);
        }
        if ($request->has('expsource')) {
            $query->where('expsource', $request->expsource);
        }
        if ($request->has('wash')) {
            $query->where('wash', $request->wash);
        }

        $records = $query->get();

        $users = User::all();

        if ($request->has('sex')) {
            $sex = $request->sex;
            $records = $records->filter(function ($record) use ($users, $sex) {
                $user = $users->where('user_id', $record->user_id)->first();
                return $user && $user->sex === $sex;
            });
        }
    
        if ($request->has('age_group')) {
            $ageGroup = $request->age_group; // Either 'under_15' or '15_and_above'
            $records = $records->filter(function ($record) use ($users, $ageGroup) {
                $user = $users->where('user_id', $record->user_id)->first();
                if ($user && isset($user->birthdate)) {
                    $birthdate = Carbon::parse($user->birthdate);
                    $age = now()->year - $birthdate->year;
                    if ($ageGroup === 'under_15') {
                        return $age < 15;
                    } elseif ($ageGroup === '15_and_above') {
                        return $age >= 15;
                    }
                }
                return false;
            });
        }

        return response()->json($records);
    }
}
