<?php

namespace HotelBooking\Http\Controllers\Frontend;

use HotelBooking\Http\Controllers\Controller;

/**
 * FrontendBaseController.
 */
class FrontendBaseController extends Controller
{
    /**
     * Save upload image from request file into uploads folder.
     *
     * @param string $path
     * @param file $file
     *
     * @return string
     */
    public function imageUpload($path, $file)
    {
        $dir = config("uploads.$path");
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        $name = $file->getClientOriginalName();
        $name = md5(time().$name);
        $file->move($dir, $name);

        return $name;
    }

    /**
     * Remove image from uploads folder.
     *
     * @param string $path
     * @param string $filename
     *
     * @return bool
     */
    public function imageRemove($path, $filename)
    {
        $dir = config("uploads.$path");
        if ($filename != null && file_exists($dir.$filename)) {
            unlink($dir.$filename);

            return true;
        }

        return false;
    }
}
