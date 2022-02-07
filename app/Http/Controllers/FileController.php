<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Contracts\IFileService;

class FileController extends Controller
{
    private $fileService;

    public function __construct(IFileService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * upload
     *
     * @param  mixed $request
     * @return void
     */
    public function upload (Request $request) {
        return response()->json(['message' => $this->fileService->upload()]);
    }
}
