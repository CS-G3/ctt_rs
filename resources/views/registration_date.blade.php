<div class="container">
    <h1>Add Registration Period</h1>

    <form method="POST" action="{{ route('registrationDate.add') }}">
        @csrf

        <div class="form-group">
            <label for="startDate">Start Date:</label>
            <input type="date" name="startDate" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="endDate">End Date:</label>
            <input type="date" name="endDate" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="STATUS">Status:</label>
            <input type="text" name="STATUS" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Registration Period</button>
    </form>
</div>
@foreach($registration_period as $period)
                    <tr>
                        <td>{{ $period->id }}</td>
                        <td>{{ $period->startDate }}</td>
                        <td>{{ $period->endDate }}</td>
                        <td>{{ $period->STATUS }}</td>
                        <td>
                        <form action="{{ route('registrationPeriod.delete', $period) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                        </td>
                    </tr>
                @endforeach