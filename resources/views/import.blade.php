<!DOCTYPE html>
<html>
<head>
    <title>Upload CSV/Excel File</title>
</head>
<body>
    <div>
        <h1>Upload CSV/Excel File</h1>

        @if(session('success'))
            <div style="color: green;">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('import.csv') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="file">Choose CSV/Excel File:</label>
            <input type="file" name="file" accept=".csv, .xls, .xlsx" required>

            <br><br>

            <button type="submit">Upload</button>
        </form>
        <form action="{{ route('rankStudents') }}" method="POST">
            @csrf
            <label for="stream">Select Stream:</label>
            <select name="stream" id="stream" class="form-control">
                <option value="Science">Science</option>
                <option value="Arts and Commerce">Arts and Commerce</option>
            </select>
        <button type="submit" class="btn btn-primary">Rank Students</button>
        </form>

    </div>
</body>
</html>