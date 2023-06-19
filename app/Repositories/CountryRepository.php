<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\Country;

class CountryRepository
{
    public $record;

    public function PaginateRecordsWithFilter($request)
    {
        /*

        $rows = \DB::table('country_new')->get();

        foreach($rows as $row)
        {
            $record = Currency::where('code', $row->currency_code)->first();

            if($record)
            {
                if (empty($record->country_name))
                {
                    $record->country_name = $row->name;
                    $record->save();
                }
            }
        }
 */


    	$records = Currency::Filter($request);

    	$records = $records
                    ->orderby('country_name')->whereNotNull('country_name')
                    ->paginate(\config('pm.cmspagination'));

    	return $records;
    }


    public function getRow($id)
    {
        return Currency::where('id', $id)->first();
    }

    public function renderRow($id = null)
    {
        $list   = $this->record;

		return view('portal.country.micro.render_row',  compact('list'))->render();
    }

    public function activateCountry($id)
    {
        $record   = $this->getRow($id);
        $record->is_active = 1;
        $record->save();

        $this->record = $record;

        return $this;
    }

    public function disableCountry($id)
    {
        $record   = $this->getRow($id);
        $record->is_active = null;
        $record->save();

        $this->record = $record;

        return $this;
    }





}
