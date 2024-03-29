<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Reservation;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;
use Dompdf\Options;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = auth()->user()->events()->with('Categories')->latest()->paginate(6);
        $categories = Categories::all();
    
            
        return view('admin.events.index', compact('events', 'categories'));
    }
    

    public function allEvents()
    {
        $events = Event::latest()->paginate(5);
        $categories = Categories::all();    
        $users = User::all();
        // dd($events);
        return view('admin.events.AllEvents', compact('events', 'categories', 'users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function updateStatus(Request $request, string $id)
    {
        // dd($request);
        // $status = $request->validate([
        //     'status' => ['required', 'in:pending,accepted,refused'],
        // ]);
            $event = Event::findOrFail($id);
        $event->update(['status' => $request->status]);
    
        return redirect()->back()->with('success', 'Status updated successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();
        return view('admin.events.create', compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
         

        $imageFileName = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageFileName = time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/events/';
            $file->move($path, $imageFileName);
        }

             Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'seats' => $request->seats,
            'price' => $request->price,
            'date' => $request->date,
            'type' => $request->type,
            'category_id' => $request->category_id, // Make sure this matches your form field name
            'image' => $imageFileName,
            'created_by' => auth()->id(),
        ]);
        
        
        // if ($request->type === 'automatic') {
        //     $event->reservations()->update(['status' => 'accepted']);
        // } else {

        //     $event->reservations()->update(['status' => 'pending']);
        // }


        return redirect()->route('events')->with('success', 'Event created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = Event::find($id);

        // You might want to add some error handling in case the announcement is not found
        if (!$event) {
            abort(404, 'Event not found');
        }

        $categories = Categories::all();

        return view('admin.events.show', compact('event', 'categories'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {

        $categories = Categories::all();

        return view('admin.events.edit', compact('event', 'categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
         
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'seats' => $request->seats,
            'price' => $request->price,
            'date' => $request->date,
            'type' => $request->type,
            'Categories_id' => $request->Categories,
            'created_by' => auth()->id(),
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'uploads/events/';
            $file->move($path, $fileName);
            $data['image'] = $fileName;
        }

        // if ($request->type === 'automatic') {
        //     $event->reservations()->update(['status' => 'accepted']);
        // } else {
            
        //     $event->reservations()->update(['status' => 'pending']);
        // }

        $event->update($data);

        return redirect()->route('events')->with('success', 'Event updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events')
            ->with('success', 'Event deleted successfully');
    }

    public function archive()
    {
        $events = Event::where('created_by', auth()->id())
            ->with('Categories')
            ->latest()
            ->onlyTrashed()
            ->paginate(5);
        $categories = Categories::all();

        return view('admin.events.archive', compact('events', 'categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function reservEvent(Request $request){

        $user_id = auth()->user()->id;
        $user_name = auth()->user()->name;
        $event_id = $request->event_id;
        $event = Event::find($event_id);

        //  $reservation = Reservation::where('user_id',$user_id);
        //  if($reservation)return redirect()->back(); 

          Reservation::create([
            'user_id' => $user_id,
            'event_id' => $event_id,
            'status' => $event->type === 'automatic' ? 'approved' : 'pending'
        ]);

        $data = ['user_name' =>$user_name , 'event' => $event->title];

        $message = 'wait for organazer to accepted';
        if($event->type === 'automatic'){
            
            $pdf = Pdf::loadView('pdf', $data );
            

            return $pdf->download('invoice.pdf');

            
        }
       
        return redirect()->route('home')->with('success',$message );

    }

    public function acceptReservation()
{
    $reservations = Reservation::whereIn('event_id',auth()->user()->events()->pluck('id'))->get();
    
    return view('admin/events/acceptReservation', compact('reservations'));
}
public function filter(Request $request)
{
  
    $category = $request->categories;
    $search = $request->search;
    $query = Event::query();

    if ($search) {
        $query->where('title','like',"%$search%");
    }
    if ($category && !empty($category)) {
        $query->where('category_id',$category);
    }
    $events = $query->get();
    return view('test.search',compact('events'));
}

public function updateStatusreservation(Request $request, string $id)
{
    // dd($request);
   
    $reservations = Reservation::findOrFail($id);
    $reservations->update(['status' => $request->status]);

    return redirect()->back()->with('success', 'Status updated successfully');
}


}