<?php

namespace App\Http\Controllers\site;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RestRequest;
use App\Models\Post;
use App\Models\Rest;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($url,RestRequest $request)
    {
        /** @var Rest $rests */
        $rest = Rest::where('url', $url)->first();

        return view('home.index', [
            'rest' => $rest,
        ]);
    }

    public function print($url,RestRequest $request)
    {
        /** @var Rest $rests */
        $rest = Rest::where('url', $url)->first();

        return view('home.print', [
            'rest' => $rest,
        ]);
    }

}
