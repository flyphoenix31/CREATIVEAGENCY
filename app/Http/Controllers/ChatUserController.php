<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Chat\Message;

class ChatUserController extends Controller
{

    // Search Contact
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $datas = User::where('name', 'LIKE', '%' . $request->search . "%")->orderBy('name')->get();
            $contacts = $datas->groupBy(function ($item, $key) {
                return substr($item->name, 0, 1);
            });
            $htmldata = view('portal.chat.layouts.tabpane-contact-list')->with('contacts', $contacts)->render();
            return Response($htmldata);
        }
    }

    // Search Recent chat Userlist
    public function recentsearch(Request $request)
    {
        if ($request->ajax()) {

            $users = DB::select("SELECT chatdata.*,users.id,users.name,'' as thumb from (SELECT t1.*, CASE WHEN t1.from_user != " . Auth::id() . " THEN t1.from_user ELSE t1.to_user END AS userid , (SELECT SUM(is_read=0) as unread FROM `messages` WHERE messages.to_user=" . Auth::id() . " AND messages.from_user=userid GROUP BY messages.from_user) as unread
                FROM messages AS t1
                INNER JOIN
                (
                    SELECT
                        LEAST(`from_user`, `to_user`) AS sender_id,
                        GREATEST(`from_user`, `to_user`) AS receiver_id,
                        MAX(id) AS max_id
                    FROM messages
                    GROUP BY
                        LEAST(sender_id, receiver_id),
                        GREATEST(sender_id, receiver_id)
                ) AS t2
                    ON LEAST(t1.`from_user`, t1.`to_user`) = t2.sender_id AND
                    GREATEST(t1.`from_user`, t1.`to_user`) = t2.receiver_id AND
                    t1.id = t2.max_id
                    WHERE t1.`from_user` = " . Auth::id() . " OR t1.`to_user` =" . Auth::id() . ") chatdata JOIN users On users.id=userid  and users.name LIKE '%" . $request->search . "%' ORDER BY chatdata.id DESC");

            $htmldata = view('portal.chat.layouts.tabpane-recent-contact-list')->with('users', $users)->render();
            return Response($htmldata);
        }
    }

    // Search Selected user chat messages
    public function messagesearch(Request $request)
    {
        if ($request->ajax()) {
            $my_id = Auth::id();
            $user_id = $request->userid;
            $serachquery = $request->search;

            $messages = Message::where(function ($query) use ($user_id, $my_id, $serachquery) {
                $query->where('from_user', $user_id)->where('to_user', $my_id)->where('message', 'LIKE', '%' . $serachquery . "%");
            })->oRwhere(function ($query) use ($user_id, $my_id, $serachquery) {
                $query->where('from_user', $my_id)->where('to_user', $user_id)->where('message', 'LIKE', '%' . $serachquery . "%");
            })->get();

            $chatUser = User::find($user_id);

            $htmldata = view('portal.chat.layouts.message-conversation')->with(['messages' => $messages])->with(['chatUser' => $chatUser])->render();
            return Response($htmldata);
        }
    }

}
