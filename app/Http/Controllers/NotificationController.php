<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->user()->id;
        $notifications = Notification::all()->where(['user_id' => $id]);

        return response()->json(['notifications' => $notifications]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate(['id' => 'required']);
        $id = $request->id;
        $user_id = $request->user()->id;
        $notification = Notification::find($id);

        if ($notification !== NULL && $notification->user_id == $user_id) {
            $notification->delete();
        }

        return back();
    }
}
