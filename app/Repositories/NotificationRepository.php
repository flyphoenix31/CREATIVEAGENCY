<?php

namespace App\Repositories;

use App\Models\Notification\Notification;

class NotificationRepository
{
    public function getNotificationList($request)
    {
        $userId  = $request->user()->id;

        $records = Notification::where('user_id', $userId)->IsType($request->type_id)->latest()->limit(5)->get();

        return $records;
    }

    public function renderNotificationList($request)
    {
        $notifications = $this->getNotificationList($request);

        $notificationcount = null;

        if (count($notifications) > 0)
        {
            $notificationcount = true;
        }

        $render   = view('portal.inc.notification',  compact('notifications', 'notificationcount'))->render();

        return $render;

    }

    public function markAsRead($request)
    {
        $userId = $request->user()->id;

        Notification::where('id', $request->id)
                        ->where('user_id', $userId)
                        ->update(['is_read' => 1]);

        return TRUE;
    }

    public function markAllAsRead($request)
    {
        $userId = $request->user()->id;

        Notification::where('user_id', $userId)
                        ->update(['is_read' => 1]);

        return TRUE;
    }


    public function markAsUnread($request)
    {
        $userId = $request->user()->id;

        Notification::where('id', $request->id)
                        ->where('user_id', $userId)
                        ->update(['is_read' => 0]);

        return TRUE;
    }

    public function clearNotification($request)
    {
        $userId = $request->user()->id;

        Notification::where('id', $request->id)
                        ->where('user_id', $userId)
                        ->delete();

        return TRUE;
    }

    public function clearAllNotification($request)
    {
        $userId = $request->user()->id;

        Notification::where('user_id', $userId)->delete();

        return TRUE;
    }

    public function notificationTypes()
    {
        return [
            'system' => ['id' => 1, 'name' => 'system' ],
            'jobs'   => ['id' => 2, 'name' => 'jobs' ],
            'files'  => ['id' => 3, 'name' => 'files' ],
        ];
    }
}
