<?php

namespace App\Models;

use Illuminate\Database\Console\Migrations\StatusCommand;

class FileUpload
{
    public static function upload($request, $file_name, $upload_dir)
    {
        if ($request->hasFile($file_name)) {
            $file = $request->$file_name;
            $filename = time().'.'.$file->getClientOriginalExtension();
            $up_path = 'uploads/'.date('Y-m').'/'.$upload_dir;
            $path = $file->move($up_path, $filename);

            if ($file->getError()) {
                $request->session()->flash('warning', $file->getErrorMessage());

                return false;
            }

            return $path;
        }
    }
}