<?php

namespace App\Libraries;

use App\Libraries\ClearString;
use Hash;

class RenameImage
{
    public static function set($string, $extension)
    {

        return $string = ClearString::set( Hash::make($string) ) . '.' . $extension;

    }
}
