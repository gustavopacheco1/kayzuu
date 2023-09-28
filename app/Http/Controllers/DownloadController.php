<?php

namespace App\Http\Controllers;

class DownloadController extends Controller
{
    public function index()
    {
        $clients_url = config('tibia.client_download_url');

        return view('download.index', ['clients_url' => $clients_url]);
    }
}
