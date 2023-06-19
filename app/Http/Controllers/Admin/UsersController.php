<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

use App\Models\User\UserStatus;
use App\Models\User\Gender;

use Spatie\Permission\Models\Permission;

use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
use App\Http\Requests\Admin\ResetPasswordUsersRequest;
use App\Http\Requests\Customer\ResetPasswordCustomerRequest;
use App\Http\Requests\Admin\StoreAddressRequest;
use App\Traits\FileUploadTrait;

class UsersController extends Controller
{
    use FileUploadTrait;

    public function render_user_detail($id)
    {
    	$record   = User::with('status')->where('id', $id)->get();

		$record   =  view('portal.users.render_data', ['result' => $record])->render();
		return $record;
    }

    public function get_userstatus(Request $request)
    {
        $result   = User::with('status')->where('id', $request->id)->first();
        $statuses = UserStatus::all();
        $render   = view('users.render_status',  compact('result','statuses'))->render();
        return response()->json(['success' => true,'record'=>$render]);
    }

    public function update_userstatus(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if (!$user)
        {
            return response()->json(['success' => false]);
        }
        $user->status_id = $request->status_id;
        $user->Save();

        $render = self::render_user_detail($user->id);

        return response()->json(['success' => true,'mode' => 'edit','record'=>$render,'id'=>$request->id]);
    }

    public function update_password(ResetPasswordUsersRequest $request)
    {
        $user = User::where('id', $request->id)->first();
        $user->password = \Hash::make($request->password);
        $user->save();

        return response()->json(['success' => true]);
    }

	public function showuser(Request $request)
    {
    	$id       = $request->id;
		$result   = User::with('status')->where('id', $id)->first();
		$roles    = Role::all()->except([1]);
		$statuses = UserStatus::all();
        $userRole = '';

        if (!empty($result->roles))
        {
            $userRole = $result->getRoleNames();
        }

        $genders  = Gender::all();
		$render   = view('portal.users.render_edit',  compact('result','roles','statuses','genders', 'userRole'))->render();

		return response()->json(['success' => true,'record'=>$render]);
    }


	/**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $attri  = [
            'category_name'    => 'UserList',
            'page_name'        => 'UserList',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        if ($request->ajax())
        {
            $users = User::with('status')->Filter((object)$request->all());

            $result = $users->latest()->paginate(\config('pm.pagination'));

            return view('portal.users.ajaxlist',  compact('result'))->render();
        }

        $page     = 'users.list';
        $roles    = Role::all();
        $genders  = Gender::all();
        $statuses = UserStatus::all();
        $result   = collect([]);

        return view('portal', compact('page','roles','statuses','result','genders', 'roles', 'attri'));
    }

	public function update_user(UpdateUsersRequest $request)
    {
        $user = User::where('id', $request->id)->first();
		if (!$user)
		{
			return response()->json(['success' => false]);
		}
        $user->roles()->detach();
        $user->update($request->except(['id']));

        $roles = $request->role ? $request->role : [];

        $user->assignRole($roles);
        $user->save();

		$render = self::render_user_detail($user->id);
		return response()->json(['success' => true,'mode' => 'edit','record'=>$render,'id'=>$request->id]);
    }

	public function delete_user(Request $request)
    {
        $user = User::where('id', $request->id)->first();

        if(!$user)
        {
            return response()->json(['success' => false,'id'=>$request->id,'message' => 'Unknown User.']);
        }
        if ($user->username == 'superadmin')
        {
            return response()->json(['success' => false,'id'=>$request->id,'message' => 'You cant delete this record.']);
        }

        $user->delete();
        return response()->json(['success' => true,'id'=>$request->id]);
    }


    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersRequest $request)
    {
        $user = User::create($request->all());
        $user->status_id = 1;
        $user->username  = strtolower($request->username);
        $user->save();
        $role = $request->role ? $request->role : [];
		$user->assignRole($role);
		$render = self::render_user_detail($user->id);
		return response()->json(['success' => true,'mode' => 'create','record'=>$render]);
    }

    public function myProfile()
    {
        $attri  = [
            'category_name'    => 'myProfile',
            'page_name'        => 'myProfile',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];
        $page   =  'users.profile';
        $tabname = 'profile';
        $user   = \Auth::user();
        $gender_list = Gender::pluck('name','id');

        $result = User::with('status','gender')->where('id', $user->id)->first();

       return view('portal',compact('page','user','result','gender_list', 'attri'));
    }

    public function postUpdateMyProfile(Request $request)
    {
        $messages = [
            'fullname.required' => 'Please Enter Full Name',
            'new_password.required' => 'Please Enter a Valid Email'
        ];

        $validator = \Validator::make($request->all(), [
            'name' => 'required:min:3',
            'email' => 'required|email',
            'phone' => 'required'
        ], $messages);

        $user   = \Auth::user();

        if ($request->birthdate)
        {
            $user->birthdate = date('Y-m-d', strtotime($request->birthdate));
        }



        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->about =$request->about;

        $user->save();

        return response()->json(['success' => true,]);

    }


    public function updateCredentials()
    {
        $page   =  'users.changePassword';
        return view('portal',compact('page'));
    }

    public function postupdateCredentials(Request $request)
    {
        $messages = [
            'old_password.required' => 'Please Enter your old password',
            'new_password.required' => 'Please Enter your new password',
            'new_confirm_password.required' => 'Please Confirm your password',
            'new_confirm_password.same' => 'This field must match new password',
        ];

        $validator = \Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required',
            'new_confirm_password' => 'required|same:new_password',
        ], $messages);

        if ($validator->fails()) {

            return redirect()->back()->withInput()->withErrors($validator);
        }
        $user = \Auth::user();
        if (\Hash::check($request->input('old_password'), $user->password)) {

            /* change and save password */
            $user->password = \Hash::make($request->input('new_password'));
            $user->save();

            return \Redirect::route('myprofile')->with('success', 'Password Updated Successfully');
        } else {

            return \Redirect::route('myprofile')->with('danger', 'Password Update Failed');
        }
    }


    public function bulk_delete_user(Request $request)
    {
        $ids = explode(",", $request->ids);
        $deleteUserIds = [];
        try {
            $users = User::whereIn('id' , $ids)
            ->get();
            $ispreventdelete = null;

            foreach ($users as $user)
            {
                if ($user->username != 'superadmin')
                {
                    $deleteUserIds[] = $user->id;
                }

            }

            if ($deleteUserIds)
            {
                $users = User::whereIn('id' , $deleteUserIds)
                ->delete();
            }
        }
        catch(\Exception $exception) {
            \Log::error($exception);
        }

        if ($ispreventdelete)
        {
            return response()->json(['success' => true, 'message' => 'We skip one or more users from deletion.They have active Store.']);
        }
        return response()->json(['success' => true]);
    }

	public function update_bulk_userstatus(Request $request)
    {
        $ids = explode(",", $request->ids);
		try {
            $ids = self::remove_element($ids,'1');
            User::whereIn('id' , $ids)->update(['status_id' => $request->status_id]);
        }
        catch(\Exception $exception) {
        }
        return response()->json(['success' => true]);
    }

    public function remove_element($array,$value) {
        return array_diff($array, (is_array($value) ? $value : array($value)));
    }



    public  function store_profile_image(Request $request)
    {
        $user      = \Auth::user();
        $username  = $user->username;

       // print_r($request->all());
        //die();

        if ($request->hasFile('profile_image'))
        {

            $this->flushAndSaveFile($user, 'profile_image', 'user_image');

            return response()->json( [ 'success' => 'true' ] );

            return response()->json( [ 'success' => 'true', 'profilepic' => $url] );
        }
        return response()->json( [ 'success' => 'false'] );
    }



}
