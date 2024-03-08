<?php

namespace App\Http\Controllers;

use App\Models\Event;
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
        $events = Event::where('status', 'accepted')->paginate(6);
        
 


        return view('welcome', compact('events'));
    }
}
