<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactMessageRequest;
use App\Http\Resources\ContactMessageResource;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    // POST /api/v1/contact
    public function store(StoreContactMessageRequest $request)
    {
        $msg = ContactMessage::create($request->validated());
        // TODO: dispatch Mail/Notification/Job إذا رغبت
        return (new ContactMessageResource($msg))
            ->additional(['message' => 'Thank you. We will contact you soon.']);
    }
}
