<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
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
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false]);
    }
}
