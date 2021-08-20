<?php

namespace App\Http\Controllers;
use App\Http\Requests\SendEstimationsNotificationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\EstimationsNotification;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('product');
    }
    public function read_notification($id){
        $notification = auth()->user()->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->delete();
            return response($notification);
        }
    }

    public function sendEstimationsNotification(SendEstimationsNotificationRequest $request) {
        $userSchema = User::where('id', $request->for)->orWhere('id', $request->pm)->get();
        if($userSchema) {
            $estimationData = [
                'body' => $request->body,
                'thanks' => 'Thank you!',
                'estimationText' => 'Check it out!',
                'estimationUrl' => $request->url,
                'estimation_id' => $request->project . '' . $request->body
            ];
            Notification::send($userSchema, new EstimationsNotification($estimationData));
        }

        return response()->json('Notification Sent!');
    }
}
