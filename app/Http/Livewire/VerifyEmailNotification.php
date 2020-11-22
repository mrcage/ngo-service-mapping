<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VerifyEmailNotification extends Component
{
    public function render()
    {
        return view('livewire.verify-email-notification');
    }

    public function sendEmailVerificationNotification()
    {
        Auth::user()->sendEmailVerificationNotification();

        session()->flash('verificationSentMessage', 'Verification e-mail has been sent.');
    }
}
