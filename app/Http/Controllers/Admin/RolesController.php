<?php

namespace App\Http\Controllers\Admin;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRolesRequest;
use App\Http\Requests\Admin\UpdateRolesRequest;
use Validator;

class RolesController extends Controller
{
	/**
     * Display a listing of Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $attri  = [
            'category_name'    => 'settings',
            'page_name'        => 'RoleList',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

		$result = Role::all();

		$permissions = Permission::all();
        $module = \App\Models\PermissionModule::select('*')->with('permission')->get();

        $page   =  'roles.list';

		return view('portal', compact('result','page','module' ,'permissions', 'attri'));

    }

    /**
     * Show the form for creating new Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get()->pluck('name', 'name');

		$page = 'roles.create';

        return view($page, compact('permissions','page'));
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param  \App\Http\Requests\StoreRolesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		//StoreRolesRequest
		$validator = Validator::make($request->all(), [
			'name'   => 'required|string|min:2|unique:roles,name',
		]);

		if ($validator->fails()) {
			return response()->json(['success' => false, 'message' => $validator->errors()]);
		}

        $role = Role::create($request->except('permission','cipk_id','cipd_id'));
        $permissions = $request->input('permission') ? $request->input('permission') : [];
        $role->givePermissionTo($permissions);

        $render = self::render_role_detail($role->id);

        return response()->json(['success' => true,'record'=>$render,'id'=>$role->id]);
    }


    /**
     * Remove Role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $role = Role::findOrFail($request->id);

        if ($role->is_locked == 1)
        {
            return response()->json(['success' => false,'id'=>$request->id]);
        }
        $role->delete();

        return response()->json(['success' => true,'id'=>$request->id]);
    }


	public function get_role_with_permission(Request $request)
    {
		$role = Role::find($request->id);

		$id = $request->id;

        $module      = \App\Models\PermissionModule::select('*')->with('permission')->get();

		$rolePermissions = \DB::table("role_has_permissions")->where("role_has_permissions.role_id",$request->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

            $permissions = Permission::all();

        $page       =  'roles.list';

		$render     =  view('portal.roles.render_edit', compact('id','role','rolePermissions','module' ,'permissions') )->render();

		return response()->json(['success' => true,'record'=>$render,'id'=>$request->id]);
	}


	public function update_role_permission(Request $request)
    {
		$request->validate([
			'name'      => 'required'
		]);

		$role = Role::find($request->id);
        $role->update($request->except('permission','id'));

        $permissions = $request->input('permission') ? $request->input('permission') : [];
        $role->syncPermissions($permissions);

		$render = self::render_role_detail($request->id);

		return response()->json(['success' => true,'record'=>$render,'id'=>$request->id]);
	}

	public function render_role_detail($id)
    {
    	$result[]   = Role::find($id);
		$permissions = \DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
		$permissions = Permission::all();

		$record   =  view('portal.roles.render_data', compact( 'result'  ) ) ->render();

		return $record;
    }



}
