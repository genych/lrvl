<?php

namespace App\Http\Controllers;

use App\Models\Story;

class FeedController extends Controller
{
    public function list()
    {
        return Story::orderBy('hn_id', 'desc')->paginate(20);
    }

    public function del(Story $story)
    {
        return $story->delete();
    }
}
