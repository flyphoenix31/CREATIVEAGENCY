<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Setting\Setting;
use App\Setting\SettingOption;
use Illuminate\Http\Request;
use Auth;
use DB;
//Models
use App\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        \Log::info("coming to index function");
        if ($request->ajax()) {
            //filter
            if ($request->setting_value) {
                $result = Setting::where(function ($query) use ($request) {
                    $query->where('label', 'like', '%' . $request->setting_value . '%')
                        ->orWhere('name', 'like', '%' . $request->setting_value . '%')
                        ->orWhere('val', 'like', '%' . $request->setting_value . '%');
                })
                ->get();
            }
            return view('admin.setting.ajaxlist',  compact('result'))->render();
        }
        $page   =  'admin.setting.index';
        $settings = Setting::all();
        return view('portal', ['result' => $settings,'page' => $page]);
        //return view('admin.setting.index');
    }

    public function store(Request $request)
    {
        $rules = Setting::getValidationRules();
        $data = $this->validate($request, $rules);

        $validSettings = array_keys($rules);

        foreach ($data as $key => $val) {
            if( in_array($key, $validSettings) ) {
                Setting::add($key, $val, Setting::getDataType($key));
            }
        }

        return redirect()->back()->with('status', 'Settings has been saved.');
    }

    //add new setting with specific type
    public function addNewSetting(Request $request)
    {
        $setting_type = $request->setting_type;
        $page   =  'admin.setting.add';
        return view('portal', compact('page','setting_type'));
    }

    public function postAddNewSetting(Request $request)
    {
        $messages = [
            //'announce_title.required' => 'Announcement Title is Required',
            'setting_key.required' => 'Setting Key is Required',
            'setting_label.required' => 'Setting Label is Required',
            'setting_value.required' => 'Setting Value is Required',
            'setting_key.unique' => 'Key Entered is already exists. Please Enter a Different Key',
            'setting_label.unique' => 'Label Entered is already exists. Please Enter a Different Label'
        ];
        $validator = \Validator::make($request->all(), [
            'setting_key' => 'required|unique:settings,name',
            'setting_label' => 'required|unique:settings,label',
            'setting_value' => 'required'
        ], $messages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        DB::transaction(function () use($request,&$add_setting) {
            $add_setting = Setting::add($request->setting_label, $request->setting_key, $request->setting_value, $request->field_type,'string');
            //add options to other model if the field type is select
            if($request->field_type=="select")
            {
                foreach ($request->config_select as $key => $value) {
                    $setting_option = new SettingOption;
                    $setting_option->setting_id = $add_setting->id;
                    $setting_option->setting_option = $request->config_select[$key]['value'];
                    $setting_option->save();
                }

            }
        });
        return response()->json(['success' => 'New Global Setting saved successfully']);
    }


    //edit specific global config
    public function editSetting($id)
    {
        $setting_id = Crypt::decryptString($id);
        $setting  = Setting::find($setting_id);
        //get all available options if any
        $setting_options = SettingOption::where('setting_id', $setting_id)->get();

        $page   =  'admin.setting.edit';
        return view('portal', compact('page','setting','setting_options'));

    }

    public function postEditSetting(Request $request)
    {
        $messages = [
            //'announce_title.required' => 'Announcement Title is Required',
            'setting_key.required' => 'Setting Key is Required',
            'setting_label.required' => 'Setting Label is Required',
            'setting_value.required' => 'Setting Value is Required',
            'setting_key.unique' => 'Key Entered is already exists. Please Enter a Different Key',
            'setting_label.unique' => 'Label Entered is already exists. Please Enter a Different Label'
        ];
        $validator = \Validator::make($request->all(), [
            'setting_key' => 'required|unique:settings,name,' . $request->setting_id . ',id',
            'setting_label' => 'required|unique:settings,label,' . $request->setting_id . ',id',
            'setting_value' => 'required'
        ], $messages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        DB::transaction(function () use($request,&$setting,&$update) {
            $setting = Setting::updateSetting($request->setting_label, $request->setting_key, $request->setting_value, $request->field_type,'string');
            \Log::info("last inserted value".$setting->id);
            //add options to other model if the field type is select
            if($request->field_type=="select")
            {
                foreach ($request->config_select as $key => $value) {
                    $update = SettingOption::updateOrCreate(
                        ['setting_id' => $setting->id, 'setting_option' => $request->config_select[$key]['value']]
                    );
                }

            }
        });
        /*if($setting){
			return \Redirect::route('settings')->with('success','Global Setting Updated successfully...');
		}else{
        	return \Redirect::route('settings')->with('error','Problem in saving Global Setting !!');
        }*/
        return response()->json(['success' => 'Global Setting Updated Successfully']);
    }
}
