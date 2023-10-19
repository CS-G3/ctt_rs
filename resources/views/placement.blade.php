<div class="container">
        <h1>Add Placement</h1>
        <form method="POST" action="{{ route('placement.add') }}">
            @csrf

            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" name="location" id="location" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="time">Time:</label>
                <input type="datetime-local" name="time" id="time" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Placement</button>
        </form>
    </div>

    @foreach ($placement as $placementItem)
        <tr>
            <td>{{ $placementItem->location }}</td>
            <td>{{ $placementItem->time }}</td>
            <td>    <form action="{{ route('placement.delete', $placementItem) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete</button>
</form><td>
        </tr>
    @endforeach
