<?php

namespace App\Services;

use App\Services\Contracts\IFileService;

class FileCustomService implements IFileService {

    public function __construct()
    {

    }

    public function upload () {
        return 'Subiendo archivo desde el servicio custom';
    }
}
