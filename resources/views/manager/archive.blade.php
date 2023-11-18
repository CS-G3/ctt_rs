@if(Auth::check())
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archive</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body class="d-flex bg-secondary">

@include('manager.sidenav')

<div class="bg-light ml-1 p-4 w-100">

<h1>Archive Contents</h1>

@if ($archives->isEmpty())
    <p>No records found in the archive.</p>
@else
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>File Name</th>
                <th>Archived Date</th>
                <th>Archived By</th>
                <th style="text-align:center;">Action</th> 
            </tr>
        </thead>
        <tbody>
            @foreach ($archives as $archive)
                <tr>
                    <td>{{ $archive->name }}</td>
                    <td>{{ $archive->archivedDate }}</td>
                    <td>{{ $archive->archivedBy }}</td>
                    <td style="display:flex; justify-content:center;">
                        {{-- Add a button to trigger the delete action --}}
                        <form action="{{ route('archive.delete', $archive->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </form>

                        {{-- Download button --}}
                        <a href="{{ route('archive.butDownload', $archive->id) }}" class="btn btn-primary btn-sm ml-3">
                            <span class="material-symbols-outlined">download</span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

@else
<p>You are not logged in.</p>
@endif

</div>
</body>
</html>
