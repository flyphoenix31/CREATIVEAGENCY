<?php

namespace App\Services;

use \App\Models\Notification\Notification;

class NotificationService
{
    public $title   = NULL;
    public $message = NULL;
    public $user    = NULL;
    public $record  = NULL;

    public function triggerNotification($user, $type = 'system', $title = null, $message=null )
    {
        switch($type)
        {
            case 'system':
                $type = 1;
            break;
            case 'job':
                $type = 2;
            break;
            case 'file':
                $type = 3;
            break;
            case 'quotation':
                $type = 4;
            break;
        }

        $data = ['user_id' => $user->id, 'subject' => $title, 'content' => $message, 'type_id' => $type, 'is_read' => 0 ];
        $record = Notification::create($data);

        if ($record)
        {
            $this->record = $record;
            self::setData($user,$title, $message);
        }

        return $this;
    }

    public function setData($user,$title, $message)
    {
        self::setNotificationData($title, $message);
        self::setUserData($user);
    }

    public function setNotificationData($title, $message)
    {
        $this->title   = $title;
        $this->message = $message;
    }

    public function setUserData($user)
    {
        $this->user = $user;
    }

    public function setMessage($type, $order)
    {
        $message = '';
        $title   = '';
        switch($type)
        {
            case 'newjob':
                $title   = 'New Job Alert';
                $message = 'You have a new Job order. please review it';
            break;

        }

        $this->title   = $title;
        $this->message = $message;
        $this->updateMessage();
        return $this;
    }

    public function updateMessage()
    {
        $record = $this->record;

        if ($record)
        {
            $record->subject = $this->title;
            $record->content = $this->message;

            $record->save();
        }
    }

}
