<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Admin\RestRequest;
use App\Models\User;
use App\Models\Rest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(RestRequest $request)
    {
        /** @var Rest $rests */
        // $user = Auth::user();
        $user = User::where('id', Auth::id())->first();
        return view('admin.index', [
            'user' => $user,
        ]);
    }


}
