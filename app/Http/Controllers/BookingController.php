<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Service;  // Ensure this model exists
    use App\Models\Booking;  // Ensure this model exists

    class BookingController extends Controller
    {
        // Step 1: Show the booking form
        public function create()
        {
            // Fetch available services to display in the dropdown
            $services = Service::all();
            
            // Return a view and pass the services to the form
            return view('bookings.create', compact('services'));
        }

        // Step 2: Handle the form submission
        public function store(Request $request)
        {
            // Step 2.1: Validate the incoming request
            $validated = $request->validate([
                'service_id' => 'required|exists:services,id',  // Ensure the service exists
                'start_time' => 'required|date|after_or_equal:now',  // Start time must be a future date
                'end_time' => 'required|date|after:start_time',  // End time must be after the start time
            ]);

            // Step 2.2: Check for double booking
            $isBooked = Booking::where('service_id', $validated['service_id'])
                ->where(function($query) use ($validated) {
                    $query->whereBetween('start_time', [$validated['start_time'], $validated['end_time']])
                        ->orWhereBetween('end_time', [$validated['start_time'], $validated['end_time']]);
                })->exists();

            if ($isBooked) {
                return back()->withErrors('This time slot is already booked.');  // Error message
            }

            // Step 2.3: Store the booking in the database
            Booking::create([
                'user_id' => auth()->id(),  // Get the authenticated user ID
                'service_id' => $validated['service_id'],  // The service being booked
                'start_time' => $validated['start_time'],  // The start time of the booking
                'end_time' => $validated['end_time'],  // The end time of the booking
            ]);

            // Redirect back to the bookings page with a success message
            return redirect()->route('bookings.index')->with('success', 'Service booked successfully!');

        }
        public function index()
        {
            // Fetch bookings for the logged-in user
            $bookings = Booking::where('user_id', auth()->id())->with('service')->get();
        
            // Return the view with the user's bookings
            return view('bookings.index', compact('bookings'));
        }
        
    }

