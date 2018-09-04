<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Http\Resources\MovieResource;
use App\Http\Resources\MovieCollection;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(){
    	return new MovieCollection(Movie::orderBy('up_votes','DESC')->get());
    }

    public function store(Request $request){
    	$movie = new Movie;
    	$movie->name = $request->name;
    	$movie->save();
    	return new MovieResource($movie);
    }

    public function up_vote($id){
    	$movie = Movie::findOrFail($id);
    	$movie->up_votes = $movie->up_votes + 1;
    	$movie->save();
    	return new MovieResource($movie);
    }

    public function down_vote($id){
    	$movie = Movie::findOrFail($id);
    	$movie->down_votes = $movie->down_votes + 1;
    	$movie->save();
    	return new MovieResource($movie);
    }
}
