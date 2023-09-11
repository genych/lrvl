<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function view(Request $request)
    {
        $page = $request->query('page');
        $feed = Story::orderBy('hn_id', 'desc')
            ->paginate(10, ['*'], 'page', $page);
        return view('feed', ['feed' => $feed]);
    }

    public function del(Story $story)
    {
        return $story->delete();
    }
}
