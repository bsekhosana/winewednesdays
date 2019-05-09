<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class HomeController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Show homepage.
     *
     * @return \Illuminate\View\View
     */
    public function showHomepage() : View
    {
        return view('welcome');
    }
}
