<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User; // Assuming you're using the default User model
use Illuminate\Support\Facades\Hash;

class HashExistingPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:hash-passwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hashes existing users passwords using bcrypt';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Fetch all users
        $users = User::all();

        foreach ($users as $user) {
            // Check if the password is already hashed (optional)
            if (! Hash::needsRehash($user->password)) {
                // Only hash the password if it is not already hashed
                continue;
            }

            // Hash the password
            $hashedPassword = Hash::make($user->password);

            // Update the user with the hashed password
            $user->update(['password' => $hashedPassword]);

            $this->info("Password for user {$user->id} updated successfully.");
        }

        $this->info('All passwords have been hashed successfully.');
    }
}
