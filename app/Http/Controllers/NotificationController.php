<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\NotificationRepository;

class NotificationController extends Controller
{
    public function __construct(NotificationRepository $notificationrepository)
    {
        $this->notificationrepository = $notificationrepository;
    }

    public function list(Request $request)
    {
        $result = $this->notificationrepository->renderNotificationList($request);

        return response()->json(['success' => true,'render'=>$result]);
    }

    public function markAsRead(Request $request)
    {
        $rules = [ 'id' => 'required' ];

        $validator = \Validator::make($request->only('id'), $rules ,[]);

        if ($validator->fails())
            return response()->json(['success' => false,'errors'=>$validator->errors()->all()]);

        $result = $this->notificationrepository->markAsRead($request);

        return response()->json(['success' => true,'result'=>$result]);
    }

    public function markAllAsRead(Request $request)
    {
        $result = $this->notificationrepository->markAllAsRead($request);

        return response()->json(['success' => true,'result'=>$result]);
    }

    public function markAsUnread(Request $request)
    {
        $rules = [ 'id' => 'required' ];

        $validator = \Validator::make($request->only('id'), $rules ,[]);

        if ($validator->fails())
            return response()->json(['success' => false,'errors'=>$validator->errors()->all()]);

        $result = $this->notificationrepository->markAsUnread($request);

        return response()->json(['success' => true,'result'=>$result]);
    }

    public function clearRecord(Request $request)
    {
        $rules = [ 'id' => 'required' ];

        $validator = \Validator::make($request->only('id'), $rules ,[]);

        if ($validator->fails())
            return response()->json(['success' => false,'errors'=>$validator->errors()->all()]);

        $result = $this->notificationrepository->clearNotification($request);

        return response()->json(['success' => true,'result'=>$result]);
    }

    public function clearAll(Request $request)
    {
        $result = $this->notificationrepository->clearAllNotification($request);

        return response()->json(['success' => true,'result'=>$result]);
    }

    public function getCount(Request $request)
    {
        $userId = $request->user()->id;

        $result = $this->notificationrepository->getCount($userId, $request->type);

        return response()->json(['success' => true,'result'=>$result]);
    }
}
