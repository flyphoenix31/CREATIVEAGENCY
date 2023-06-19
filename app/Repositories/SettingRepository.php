<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Setting\Setting;
use App\Models\Invoice\MailQuotation;
use App\Traits\FileUploadTrait;

class SettingRepository
{
    use FileUploadTrait;

    public function getSettings()
    {
    	return Setting::find(1)->first();
    }

    public function UpdateSettings($request)
    {
        $record = Setting::find(1)->first();

        $record->account_number = $request->account_number;
        $record->bank_name      = $request->bank_name;
        $record->bank_code      = $request->bank_code;
        $record->bank_country   = $request->bank_country;
        $record->save();

        if($request->hasFile('invoice_logo') )
        {
            $this->flushAndSaveFile($record, 'invoice_logo', 'setting_invoice_logo');
        }

    	return Setting::find(1)->first();
    }




}
