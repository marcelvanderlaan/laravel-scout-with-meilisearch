<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use MeiliSearch\Client;

class SearchController extends Controller
{
    public function __invoke(Request $request) {

        $results = null;
        $users = User::all();

        if ($query = $request->get('query')) {
            $results = Article::search($query)->paginate(5)->withQueryString();
        }

//        if($query = $request->get('query')) {
//            $results = Article::search($query, function ($meilisearch, $query, $options) use ($request) {
//                if ($userId = $request->get('user_id')) {
//                    $options['filters'] = 'user_id=' . $userId;
//                }
//                return $meilisearch->search($query, $options);
//            })->paginate(5);
//        }

        return view('search', [
            'results' => $results,
            'users' => $users
        ]);
    }
}
