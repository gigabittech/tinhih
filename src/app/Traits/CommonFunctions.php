<?php
namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait CommonFunctions
{
    public function UploadImage($file, $fileName = "", $folderName = "images", $height = null, $width = null)
    {

        $uploads = 'assets/images/uploads';
        $filePath = 'assets/images/' . $folderName;

        $realname = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $extension = $file->getClientOriginalExtension();
        $fileName = auth()->user()->id . '_' . time() . '_' . Str::slug(($fileName != "" ? $fileName : $realname)) . "." . 'png';

        $fileName = Str::replace([' ', '-'], '_', $fileName);
        $newFile = $file->move($filePath, $fileName);

        $image_resize = Image::make($newFile->getRealPath());

        if ($width > 0 && $height > 0) {
            $image_resize->resize(null, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        if (!file_exists($filePath)) {
            mkdir($filePath, 666, true);
        }
        $finalImagePath = $filePath . '/' . $fileName;
        $image_resize->save($finalImagePath);
        $image = $finalImagePath;

        return $image;
    }


    public function GetCheckBoxValue($data, $fieldName)
    {
        if (isset($data[$fieldName]) && $data[$fieldName] == 'on') {
            return 1;
        } else
            return 0;
    }
}
