<?php

namespace App\Traits;

trait FileUploadTrait
{
    public function saveFile($model, $file, $collectionname = 'default', $filename = '')
    {
        $model->addMediaFromRequest($file)
            ->withResponsiveImages()
            ->usingName($filename.time())
            ->toMediaCollection($collectionname);
        return true;
    }

    public function flushAndSaveFile($model, $file, $collectionname = 'default', $filename = '')
    {
        $model->clearMediaCollection($collectionname);
        $model->addMediaFromRequest($file)
            ->withResponsiveImages()
            ->usingName($filename.time())
            ->toMediaCollection($collectionname);

        return true;
    }

    public function saveMultipleFiles($model, $request, $file, $collectionname = 'default')
    {
        foreach ($request->{$file} as $img)
        {
            $model->addMedia($img)
            ->withResponsiveImages()
           ->usingName($file.time())
            ->toMediaCollection($collectionname);
        }
        return true;
    }

}
