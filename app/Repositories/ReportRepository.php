<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Files\FileManagerFile;
use App\Models\Files\FileManagerFolder;
use App\Models\Files\Share;


class ReportRepository
{

    public function PaginateSharedlink($request)
    {
    	$records = Share::with('user');

    	$records = $records->latest()->paginate(\config('pm.cmspagination'));
    	return $records;
    }

}
