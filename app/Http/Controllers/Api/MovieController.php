<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Models\UserPremium;
use Illuminate\Support\Carbon;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $movies = Movie::where('title','like','%'.$search.'%')
        ->orderBy('featured', 'DESC')
        ->orderBy('created_at', 'DESC')
        ->paginate(10);

        return response()->json($movies);
    }

    public function show(Request $request, $id)
    {

        $user = $request->get('user');

        $userPremium = UserPremium::where('user_id', $user->id)->first();

        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json([
                'message' => 'movie not found'
            ], 404);
        }

        if ($userPremium) {
            $endOfSubscription = $userPremium->end_of_subscription;
            $date = Carbon::createFromFormat('Y-m-d', $endOfSubscription);
            $isValidSubscription = $date->greaterThan(now());

            if ($isValidSubscription) {
                return response()->json($movie);
            }
        }

        return response()->json(['message' => 'you dint have subscription plant']);
        // $movie = Movie::find($id);

        // if (!$movie) {
        //     return response()->json([
        //         'message' => 'movie not found'
        //     ], 404);
        // }

        // return response()->json($movie);
    }
}
