<?php

use Illuminate\Support\Str;
use Illuminate\Support\HtmlString;
use Illuminate\Contracts\Encryption\DecryptException;

function addUserActivity($type = 'default', $log = 'User Activity', $otherdatas = [])
{
    $guest = null;
    $user = \Auth::user();

    activity()
            //->performedOn($model)
            ->causedBy($user)
            ->withProperties(getUserBrowserProperty($type, $otherdatas))
            ->log($log);
}

function getUserBrowserProperty($type = 'default', $otherdatas )
{
    return $sysprop = [
        'ip' => getUserIpAddr(),
        'user_agent' => \Browser::userAgent(),
        'browser' => Browser::browserName(),
        'browser_version' => Browser::browserVersion(),
        'platform' => Browser::platformName(),
        'platform_version' => Browser::platformVersion(),
        'device_model' => Browser::deviceModel(),
        'is_bot' => Browser::isBot(),
        'type' => $type,
        'others' => $otherdatas,
    ];
}


function getUserIpAddr(){
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
 }

function formatDate($date, $format)
{
    if($date) {
        return Carbon\Carbon::parse($date)
            ->format($format);
    }

    return $date;
}

function generate_random_number ($min,$max)
{
    return mt_rand($min, $max);
}

function unique_random($table, $col, $chars = 16){

        $unique = false;
        $tested = [];

        do{
            $random = Str::random($chars);

            if( in_array($random, $tested) ){
                continue;
            }

            $count = DB::table($table)->where($col, '=', $random)->count();

            $tested[] = $random;

            if( $count == 0){
                // Set unique to true to break the loop
                $unique = true;
            }

            // If unique is still false at this point
            // it will just repeat all the steps until
            // it has generated a random string of characters

        }
        while(!$unique);


        return $random;
    }


function get_uni_key($ln)
{
    for ($randomNumber = mt_rand(1, 9), $i = 1; $i < $ln; $i++) {
        $randomNumber .= mt_rand(0, 9);
    }
    return $randomNumber;
}


function unique_numeric_random($table, $col, $chars = 16){

    $unique = false;

    $tested = [];

    do{

        $random = get_uni_key($chars);

        if( in_array($random, $tested) ){
            continue;
        }

        $count = DB::table($table)->where($col, '=', $random)->count();

        $tested[] = $random;

        // String appears to be unique
        if( $count == 0){
            // Set unique to true to break the loop
            $unique = true;
        }

        // If unique is still false at this point
        // it will just repeat all the steps until
        // it has generated a random string of characters

    }
    while(!$unique);


    return $random;
}

function set_active($path, $active = 'active') {

    return call_user_func_array('Request::is', (array)$path) ? $active : '';

}

// For add'active' class for activated route nav-item
function active_class($path, $active = 'active') {
  return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

// For checking activated route
function is_active_route($path) {
  return call_user_func_array('Request::is', (array)$path) ? 'true' : 'false';
}

// For add 'show' class for activated route collapse
function show_class($path) {
  return call_user_func_array('Request::is', (array)$path) ? 'show' : '';
}

function decryptId($id = null)
{
    try
    {
        $id  = \Crypt::decryptString($id);
        return $id;
    } catch (DecryptException $e) {
        //log the error
        abort(404);
    }
}

function encryptId($id = null)
{
    return \Crypt::encryptString($id);
}


function gettitle($id = null)
{
    $name = '';

    switch($id)
    {
        case '1':
            $name = 'Mr.';
        break;
        case '2':
            $name = 'Ms.';
        break;
        case '3':
            $name = 'Mrs.';
        break;
        case '4':
            $name = 'Dr.';
        break;
    }

    return $name;
}

/**
 * Check if directory exist, if no, then create it
 *
 * @param $directory
 * @return mixed
 */
function check_directory($directory)
{
    if (!Storage::exists($directory)) {
        Storage::makeDirectory($directory);
    }

    return $directory;
}

/**
 * Make input from request
 *
 * @param $request
 * @return array
 */
function make_single_input($request)
{
    // Create container
    $data = [];

    // Add data to array
    $data[$request->name] = $request->value;

    // Return input
    return $data;
}

/**
 * Find all key values in recursive array
 *
 * @param array $array
 * @param $needle
 * @return array
 */
function recursiveFind(array $array, $needle)
{
    $iterator = new RecursiveArrayIterator($array);
    $recursive = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::SELF_FIRST);
    $aHitList = array();
    foreach ($recursive as $key => $value) {
        if ($key === $needle) {
            array_push($aHitList, $value);
        }
    }
    return $aHitList;
}

/**
 * Get values which appears only once in array
 * @param $arr
 * @return array
 */
function appeared_once($arr)
{
    $array_count_values = array_count_values($arr);

    $single_time_comming_values_array = [];

    foreach ($array_count_values as $key => $val) {

        if ($val == 1) {
            $single_time_comming_values_array[] = $key;
        }
    }

    return $single_time_comming_values_array;
}

/**
 * Format localized date
 *
 * @param $date
 * @param string $format
 * @return string
 */
function format_date($date, $format = '%d. %B. %Y, %H:%M')
{
    $start = \Carbon\Carbon::parse($date);

    return $start->formatLocalized($format);
}


function get_file_type($file)
{
    // Get mimetype from file
    $mimetype = explode('/', $file->getMimeType());

    switch ($mimetype[0]) {
        case 'image':
            return 'image';
            break;
        case 'video':
            return 'video';
            break;
        case 'audio':
            return 'audio';
            break;
        default:
            return 'file';
    }
}


function getfileicon($file, $fullview = null, $skipimage = null)
{
    $mimetype = $file->mimetype;

    $icon = '';

    if(in_array($mimetype, ['webp', 'gif', 'jpg', 'png', 'jpeg', 'jfif']))
    {
        $error_image = '/images/default.png';

        if ($fullview == null)
        {
            $icon = '<div class="avatar avatar-lg"><img width="30px" src=""  onerror="this.src='.$error_image.'" data-src="'.$file->thumb.'" class="lazy" ></div>';
        }
        else{
            if ($skipimage == null)
            {
                $icon = '<div class="avatar avatar-lg"><img width="300px" src=""  onerror="this.src='.$error_image.'" data-src="'.$file->thumb.'" class="lazy" ></div>';
            }
        }
    }
    else if(in_array($mimetype, ['avi','mp3']))
    {
        $icon = '<i class="fad fa-file-music text-danger fa-3x"></i>';
    }
    else if ($mimetype == 'pdf')
    {
        $icon = '<i class="fad fa-file-pdf text-warning fa-3x"></i>';
    }
    else if ($mimetype == 'txt')
    {
        $icon = '<i class="fad fa-file-alt text-secondary fa-3x"></i>';
    }
    else if (in_array($mimetype, ['doc','docx']))
    {
        $icon = '<i class="fad fa-file-pdf text-info fa-3x"></i>';
    }
    else if ($mimetype == 'zip')
    {
        $icon = '<i class="fad fa-file-archive text-dark fa-3x"></i>';
    }
    else if (in_array($mimetype, ['ppt','pptx']))
    {
        $icon = '<i class="fad fa-presentation text-warning fa-3x"></i>';
    }

    else
    {
        //<i class="fad fa-folder"></i>
        $icon = '<i class="fad fa-folder text-danger fa-3x"></i>';
    }


    echo $icon;


}


function is_storage_driver($driver) {

    if (is_array($driver)) {
        return in_array(env('FILESYSTEM_DRIVER'), $driver);
    }

    return env('FILESYSTEM_DRIVER') === $driver;
}


function addactiveclass($type, $val, $icon = null)
{
    if ($type == $val)
    {
        if ($icon)
        {
            echo "text-primary";
        }
        else
        {
            echo "active";
        }

    }
}






function getsharefileicon($file, $fullview = null, $skipimage = null, $singlefile = null, $token = null)
{
    $mimetype = $file->mimetype;

    $width = '';

    if ($singlefile) $width = 'style="width: 300px !important"';

    $icon = '';

    if(in_array($mimetype, ['webp','gif','jpg','png','jpeg', 'jfif']))
    {
        $error_image = '/images/default.png';

        if ($fullview == null)
        {

            $icon = '<img width="30px" src=""  onerror="this.src='.$error_image.'" data-src="'.$file->publicimage.'?token='. $token .'" class="lazy card-img-top" >';

            $icon = '<img src="" onerror="this.src='.$error_image.'" data-src="'.$file->publicimage.'?token='. $token .'" class="lazy card-img-top">';

        }
        else{
            if ($skipimage == null)
            {
                $icon = '<img src=""  onerror="this.src='.$error_image.'" data-src="'.$file->publicimage.'?token='. $token .'" class="lazy card-img-top"'.$width.' >';
            }
        }

    }
    else if(in_array($mimetype, ['avi','mp3']))
    {
        $icon = '<i class="fad fa-file-music text-danger fa-5x"></i>';
    }
    else if ($mimetype == 'pdf')
    {
        $icon = '<i class="fad fa-file-pdf text-warning fa-5x"></i>';
    }
    else if ($mimetype == 'txt')
    {
        $icon = '<i class="fad fa-file-alt text-secondary fa-5x"></i>';
    }
    else if (in_array($mimetype, ['doc','docx']))
    {
        $icon = '<i class="fad fa-file-pdf text-info fa-5x"></i>';
    }
    else if ($mimetype == 'zip')
    {
        $icon = '<i class="fad fa-file-archive text-dark fa-5x"></i>';
    }
    else if (in_array($mimetype, ['ppt','pptx']))
    {
        $icon = '<i class="fad fa-presentation text-warning fa-5x"></i>';
    }

    else
    {
        $icon = '<i class="fad fa-folder text-danger fa-5x"></i>';
    }


    echo $icon;


}


function randomcolor()
{
    $color = ['#4361ee','#2196f3','#1abc9c','#e2a03f','#e7515a','#805dca','#3b3f5c','#ddf5f0','#1b2e4b','#009688','#ffbb44','#25d5e4','#f8538d','#e95f2b','#304aca'];

    $color = ['#4361ee','#2196f3','#1abc9c','#e2a03f','#e7515a','#304aca', '#009688', '#0e1726'];

    echo $color[array_rand($color, 1)];
}


function showuserimage($id, $type = 'thumb')
{
    $user = \App\Models\User::find($id);

    if ($type == 'thumb')
    {
        echo $user->thumb;
    }
    else
    {
        return $user->image;
    }

}
