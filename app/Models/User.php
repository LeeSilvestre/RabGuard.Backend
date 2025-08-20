<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\VerifyEmail;

class User extends Model implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    protected $fillable = [
        'fname', 'mname', 'lname', 'extension', 'sex', 'birthdate', 
        'contact', 'email', 'username', 'is_verified', 'password', 'address', 'user_photo'
    ];

    // Get the email address that should be used for verification.
    public function getEmailForVerification()
    {
        return $this->email; // Return the user's email
    }

    // Determine if the user has verified their email address.
    public function hasVerifiedEmail()
    {
        return $this->is_verified; // Check if the user is verified
    }

    // Mark the user's email address as verified.
    public function markEmailAsVerified()
    {
        $this->is_verified = 1; // Set the user's is_verified to 1
        $this->save();
    }

    // Send the email verification notification.
    public function sendEmailVerificationNotification()
    {
        // Send the default verification email
        $this->notify(new VerifyEmail); // Sends the verification email
    }
}
