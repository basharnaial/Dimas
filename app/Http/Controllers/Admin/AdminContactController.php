<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    /**
     * Display a listing of contact messages
     */
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        // Sort functionality
        $sortBy = $request->string('sort_by', 'created_at');
        $sortOrder = $request->string('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $contacts = $query->paginate(15);

        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Display the specified contact message
     */
    public function show(ContactMessage $contact)
    {
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Remove the specified contact message
     */
    public function destroy(ContactMessage $contact)
    {
        $contact->delete();

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', 'تم حذف الرسالة بنجاح');
    }

    /**
     * Bulk actions
     */
    public function bulkAction(Request $request)
    {
        $action = $request->input('action');
        $messageIds = $request->input('messages', []);

        if (empty($messageIds)) {
            return redirect()
                ->route('admin.contacts.index')
                ->with('error', 'لم يتم تحديد أي رسائل');
        }

        switch ($action) {
            case 'delete':
                ContactMessage::whereIn('id', $messageIds)->delete();
                $message = 'تم حذف الرسائل المحددة بنجاح';
                break;
                
            default:
                return redirect()
                    ->route('admin.contacts.index')
                    ->with('error', 'إجراء غير صحيح');
        }

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', $message);
    }
}
