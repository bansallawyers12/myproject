<?php

namespace App\Helpers;

class FileHelper
{
    public static function getFileIcon($type)
    {
        switch($type) {
            case 'image':
                return 'fa-image';
            case 'document':
                return 'fa-file-alt';
            case 'spreadsheet':
                return 'fa-file-excel';
            case 'presentation':
                return 'fa-file-powerpoint';
            default:
                return 'fa-file';
        }
    }
}