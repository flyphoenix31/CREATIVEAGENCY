<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Traits\FileUploadTrait;

class PortfolioRepository
{
    use FileUploadTrait;

    public $portfolio;

    public function getLatestQuotations($item = 10)
    {
    	$records = Portfolio::with('invoice','user');

    	$records = $records->latest()->limit($item)->get();
    	return $records;
    }

    public function PaginateRecordsWithFilter($request)
    {
    	$records = Portfolio::Filter($request);

    	$records = $records->latest()->paginate(\config('pm.cmspagination'));
    	return $records;
    }

    public function getRecord($id)
    {
        $record = Portfolio::Active()->isId($id)->first();

        if (!$record)
        {
            abort(404);
        }

        return $record;
    }

    public function storeRecord($request)
    {
        $model = new Portfolio();

        $insdata = $request->only($model->getFillable());
        $insdata['status_id'] = 1;

        $record = Portfolio::create($insdata);

        if($request->hasFile('portfolio_image') )
        {
            $this->saveFile($record, 'portfolio_image', 'portfolio_image');
        }

        if($request->hasFile('portfolio_banner') )
        {
            $this->saveFile($record, 'portfolio_banner', 'portfolio_banner');
        }

        return $record->id;

    }

    public function updateRecord($request)
    {
        $id = decryptId($request->id);

        $model = new Portfolio();

        $insdata = $request->only($model->getFillable());

        if(!$request->filled('is_featured')) {
            $insdata['is_featured'] = 0;
        }

        $record = Portfolio::find($id);

        if (!$record)
        {
            return FALSE;
        }

        $record->update($insdata);

        if($request->hasFile('portfolio_image') )
        {
            $this->flushAndSaveFile($record, 'portfolio_image', 'portfolio_image');
        }

        if($request->hasFile('portfolio_banner') )
        {
            $this->flushAndSaveFile($record, 'portfolio_banner', 'portfolio_banner');
        }

        return TRUE;

    }

    public function renderRecord($id)
    {
        $result   = Portfolio::where('id', $id)->first();
        $render   = view('portal.portfolio.partial.render_edit',  compact('result'))->render();
        return $render;
    }

    public function renderRow($id)
    {
        $result   = Portfolio::where('id', $id)->get();
        $render   = view('portal.portfolio.partial.render_data',  compact('result'))->render();
        return $render;
    }

    public function deleteRecord($id)
    {
        Portfolio::destroy($id);
    }


}
