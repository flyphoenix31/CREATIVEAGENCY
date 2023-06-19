<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\StorePermissionsRequest;
use App\Http\Requests\Admin\UpdatePermissionsRequest;


class PermissionsController extends Controller
{
    public function index()
    {
        $attri  = [
            'category_name'    => 'settings',
            'page_name'        => 'PermissionList',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        $result  = Permission::get();
		$page    = 'permission.list';
        $module  = \App\Models\PermissionModule::all();

        return view('portal', compact('page', 'result', 'module', 'attri'));
    }

    public function show(Request $request)
    {
        $record   = Permission::where('id',$request->id)->first();
        $module   = \App\Models\PermissionModule::all();
        $render   = view('portal.permission.render_edit', ['result' => $record , 'id'=>$record->id , 'module'=>$module ]) ->render();
        return response()->json(['success' => true,'id'=>$request->id,'record'=>$render]);
    }

    public function render_data($id)
    {
        $result   = Permission::where('id', $id)->get();
        $record   =  view('portal.permission.render_data', compact( 'result'  ) ) ->render();

        return $record;
    }

	public function store(StorePermissionsRequest $request)
    {

		$permission = Permission::create($request->all());
        $user = \App\Models\User::find(1);
        $user->givePermissionTo(Permission::all());
        $user->givePermissionTo(Permission::where('guard_name', 'web')->get());

        $render     = self::render_data($permission->id);

        return response()->json(['success' => true,'record'=>$render,'id'=>$permission->id]);
    }

	public function update(UpdatePermissionsRequest $request)
    {

		$permission = Permission::find($request->id);

        $permission->name       = $request->name;
        $permission->module_id  = $request->module_id;
        $permission->is_locked  = $request->is_locked;
        $permission->save();

        $render = self::render_data($permission->id);

        return response()->json(['success' => true,'record'=>$render,'id'=>$permission->id]);
    }

	public function destroy(Request $request)
    {
		if (!$request->id)
		{
			return response()->json(['success' => false]);
		}
        $permission = Permission::find($request->id);

		if ($permission->is_locked)
		{
			return response()->json(['success' => false]);
		}
		$permission->delete();

        return response()->json(['success' => true]);
    }

}
