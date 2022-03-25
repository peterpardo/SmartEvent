<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function viewEvents() {
        $user = User::find(Auth::user()->id);

        $scripts = [
            asset('js/user/add-event.js'),
            asset('js/user/delete-event.js'),
        ];

        return view('users.view-events', [
            'scripts' => $scripts,
            'user' => $user,
        ]);
    }

    public function addEvent(Request $request) {
        $user = User::find(Auth::user()->id);

        // Create the scheduled event
        $user->events()->create([
            'name' => Str::title($request->eventName),
            'description' => Str::ucfirst($request->eventDesc),
            'date' => $request->eventDate,
        ]);

        return back()->with('success', 'Event successfully created.');
    }

    public function deleteEvent($id) {
        Event::destroy($id);

        return back()->with('success', 'Event successfully deleted.');
    }

    public function editEvent(Request $request, $id) {
        $event = Event::find($id);

        // Update event details
        $event->name = Str::title($request->eventName);
        $event->description =  Str::ucfirst($request->eventDesc);
        $event->date =  $request->eventDate;
        $event->save();
        
        return back()->with('success', 'Event successfully updated.');
    }
}
