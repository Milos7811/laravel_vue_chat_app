<?php
namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke(): View
    {
        return view('index');
    }
}
