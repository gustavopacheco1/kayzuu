<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class DownloadController extends Controller
{
    public function index(): View
    {
        $clients_url = config('tibia.client_download_url');

        return view('download.index', ['clients_url' => $clients_url]);
    }
}
