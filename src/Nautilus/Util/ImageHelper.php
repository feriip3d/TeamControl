<?php
namespace Nautilus\Util;

class ImageHelper
{
    public function loadImage($path) : String
    {
        $path = ROOT_DIR.$path;
        if(is_file($path))
            return "data: ".(mime_content_type($path)).";base64,".(base64_encode(file_get_contents($path)));

        return 'data:;,';
    }
}