<div class="container">
        <h2>Add Record</h2>
        <form method="POST" action="{{ route('archive.add') }}">
            @csrf
            <div class="form-group">
                <label for="fileURL">File URL</label>
                <input type="text" class="form-control" id="fileURL" name="fileURL" required>
            </div>
            <div class="form-group">
                <label for="archivedDate">Archived Date</label>
                <input type="date" class="form-control" id="archivedDate" name="archivedDate" required>
            </div>
            <div class="form-group">
                <label for="archivedBy">Archived By</label>
                <input type="text" class="form-control" id="archivedBy" name="archivedBy" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Record</button>
        </form>
    </div>