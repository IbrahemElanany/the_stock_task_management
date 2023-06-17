<?php

// Status Codes
use Intervention\Image\Facades\Image;

function success()
{
    return 200;
}
function register()
{
    return 201;
}

function error()
{
    return 401;
}

function notFound()
{
    return 404;
}

function validationError()
{
    return 422;
}



if (!function_exists('callbackData')) {
    function callbackData($msg, $data = [], $status = 200)
    {
        return response()->json([
            'msg' => $msg,
            'data' => $data,
        ],$status);
    }
}

function upload($file)
{
    $imageName = time() . uniqid() . '.' . $file->getClientOriginalExtension();
    $imagePath = 'uploads/' . $imageName;
    Image::make($file)->save(public_path($imagePath));
    return $imagePath;
}


