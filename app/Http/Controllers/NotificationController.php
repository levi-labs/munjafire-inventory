<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function read($id)
    {
        $notif = Notification::where('id', $id)->first();
        $notif->is_read = 1;
        $notif->update();

        return redirect()
            ->route('products.show', $notif->product_id)
            ->with('success', 'Notification marked as read');
        // return back()->with('success', 'Notification marked as read');
    }
}
