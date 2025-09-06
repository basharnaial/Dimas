<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactMessageRequest;
use App\Http\Resources\ContactMessageResource;
use App\Models\ContactMessage;
use App\Notifications\NewContactMessage;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    // POST /api/v1/contact
    public function store(StoreContactMessageRequest $request)
    {
        $msg = ContactMessage::create($request->validated());
        
        // Send email notifications
        $emails = ['info@dimas.sa', 'design@etmaam.com.sa'];
        
        try {
            Notification::route('mail', $emails)
                ->notify(new NewContactMessage($msg));
        } catch (\Exception $e) {
            // Log the error but don't fail the request
            \Log::error('Failed to send contact notification: ' . $e->getMessage());
        }
        
        return (new ContactMessageResource($msg))
            ->additional(['message' => 'Thank you. We will contact you soon.']);
    }
}
