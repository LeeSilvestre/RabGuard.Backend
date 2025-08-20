<?php

namespace App\Console\Commands;

use App\Models\VaccinationRecord;
use App\Models\User;
use App\Services\SmsService;
use Illuminate\Console\Command;
use Carbon\Carbon;

use App\Services\TelesignService;

class SendVaccinationReminder extends Command
{
    protected $signature = 'send:vac-reminder';
    protected $description = 'Send SMS reminders to patients with a vaccination schedule today';

    protected $smsService;

    public function __construct(SmsService $smsService)
    {
        parent::__construct();
        $this->smsService = $smsService;
    }

    public function handle()
    {
        $today = Carbon::today()->toDateString();

        $records = VaccinationRecord::whereIn('date3', [$today])
            ->orWhereIn('date7', [$today])
            ->get();

        foreach ($records as $record) {
            $user = User::find($record->user_id);

            if ($user && $user->contact) {
                // Ensure contact number starts with 0
                $contact = $user->contact;
                if (substr($contact, 0, 1) !== '0') {
                    $contact = '63' . $contact; // Prepend 0 if missing
                }

                // Send reminder with formatted contact number
                $this->smsService->sendReminder($contact);
                $this->info("Reminder sent to {$contact}");
            }
        }
    }

    // protected $signature = 'send:vac-reminder';
    // protected $description = 'Send SMS reminders to patients with a vaccination schedule today';

    // protected $telesignService;

    // public function __construct(TelesignService $telesignService)
    // {
    //     parent::__construct();
    //     $this->telesignService = $telesignService;
    // }

    // public function handle()
    // {
    //     $today = Carbon::today()->toDateString();

    //     // Get records for today’s vaccination schedules
    //     $records = VaccinationRecord::whereIn('date3', [$today])
    //         ->orWhereIn('date7', [$today])
    //         ->get();

    //     foreach ($records as $record) {
    //         $user = User::find($record->user_id);

    //         if ($user && $user->contact) {
    //             // Ensure the contact number starts with 63 (for Philippines numbers)
    //             $contact = $user->contact;
    //             if (substr($contact, 0, 1) !== '0') {
    //                 $contact = '63' . $contact;
    //             }

    //             // Message text
    //             $message = "Good day! You have a vaccination schedule today. Don't forget to visit the Olongapo City ABTC!";

    //             // Send reminder via Telesign API
    //             if ($this->telesignService->sendSMS($contact, $message)) {
    //                 $this->info("Reminder sent to {$contact}");
    //             } else {
    //                 $this->error("Failed to send reminder to {$contact}");
    //             }
    //         }
    //     }
    // }
}
