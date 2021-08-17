<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class ApiController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total = Post::get();
        for($x = 0; $x < count($total); $x ++){
            $post[$x]['id'] = $total[$x]['id'];
            $post[$x]['title'] = $total[$x]['title'];
            // $post[$x]['content'] = $total[$x]['content'];
            // $post[$x]['idUser'] = $total[$x]['idUser'];
            $post[$x]['img'] = "http://localhost:8000/img/logo_bubowl_small.png";
        }

        return $post;
    }
}
