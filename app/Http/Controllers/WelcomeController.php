<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Categories; 
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve all events from the database
        $user_id = auth()->user()->id ?? '';
        $events = Event::where('status', 'accepted');
        if($user_id){
           $events= $events->whereNot('created_by', $user_id);
        }
        $events = $events->paginate(6);

        
        // Retrieve all categories
        $categories = Categories::all();
    
        return view('welcome', compact('events', 'categories'));
    }
    
    

//     public function searchByCategory(Request $request)
// {
//     // Retrieve all categories
//     $categories = Categories::all();

//     // Get the selected category ID from the request
//     $categoryId = $request->input('category_id');

//     // Retrieve events by the selected category ID
//     $events = Event::where('category_id', $categoryId)
//                 ->where('status', 'accepted')
//                 ->paginate(6);

//     return view('welcome', compact('events', 'categories'));
// }

    public function searchByTitle(Request $request)
    {
        $searchQuery = $request->input('search_query');

        $events = Event::where('title', 'like', "%{$searchQuery}%")
        -> where('status', 'accepted')
                       ->get();
                    
        $noEventsFound = $events->isEmpty();

        return view('search', compact('events', 'noEventsFound'));
    }
    

    public function show($id)
    {
        // Retrieve the event by its ID
        $event = Event::with("categories")->findOrFail($id);
    
        // Return the view with the event details
        return view('singelpageEvent', compact('event'));
    }
    

}
