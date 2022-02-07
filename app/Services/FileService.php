<?php

namespace App\Services;

use App\Services\Contracts\IFileService;

class FileService implements IFileService {

    public function __construct()
    {

    }

    public function upload () {
        return 'Subiendo archivo desde el servicio';
    }
}
