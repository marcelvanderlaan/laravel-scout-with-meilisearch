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

//        // simple search
//        if ($query = $request->get('query')) {
//            $results = Article::search($query)->get();
//        }

//        //simple search with pagination
//        if ($query = $request->get('query')) {
//            $results = Article::search($query)->paginate(5);
//        }

//        //search with where
//        if ($query = $request->get('query')) {
//            $results = Article::search($query)->where('published', 1)->paginate(5);
//        }

        if ($query = $request->get('query')) {
            $results = Article::search($query, function ($meilisearch, $query, $options) use ($request) {
                if ($userId = $request->get('user_id')) {
                    $options['filter'] = [
                       'user_id=' . $userId
                        ];
                }
                return $meilisearch->search($query, $options);
            })->paginate(5)->withQueryString();
        }

        return view('search', [
            'results' => $results,
            'users' => $users
        ]);
    }
}
