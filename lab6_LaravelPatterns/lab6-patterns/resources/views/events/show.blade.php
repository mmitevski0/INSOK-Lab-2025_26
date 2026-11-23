<h1>Event Details</h1>

<div>
    <strong>Event Name:</strong> {{ $event->name }}
</div>

<div>
    <strong>Organizers:</strong>
    <a href="{{ route('organizers.show', $event->organizer->id) }}">
        {{ $event->organizer->name }}
    </a>
</div>

<div>
    <strong>Description:</strong> {{ $event->description }}
</div>

<div>
    <strong>Type:</strong> {{ ucfirst($event->type) }}
</div>

<div>
    <strong>Event Date:</strong> {{ $event->date }}
</div>

<a href="{{ route('events.index') }}">Back to Events</a>
