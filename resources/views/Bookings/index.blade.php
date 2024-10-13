{{-- resources/views/bookings/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your Bookings</h1>

        @if($bookings->isEmpty())
            <p>You have no bookings yet.</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <td>{{ $booking->service->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->start_time)->format('M d, Y h:i A') }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->end_time)->format('M d, Y h:i A') }}</td>
                            <td>
                                <!-- Edit link (could be developed later) -->
                                <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <!-- Delete button -->
                                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this booking?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
