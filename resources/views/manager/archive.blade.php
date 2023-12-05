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

        <!-- @include('components.responsive') -->
    
        @include('manager.sidenav')
    
        <div class="bg-light ml-1 p-4 w-100" style=" overflow-x: auto;">
    
            <h1>Archive Contents</h1>
    
            <hr>
    
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ Session::get('success') }}
                    <span class="close" style="cursor: pointer;" onclick="this.parentElement.style.display='none';" aria-label="Close">
                        <span class="material-symbols-outlined" style="font-size: 1.25rem;">close</span>
                    </span>
                </div>
            @endif

            @if(Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ Session::get('error') }}
                    <span class="close" style="cursor: pointer;" onclick="this.parentElement.style.display='none';" aria-label="Close">
                        <span class="material-symbols-outlined" style="font-size: 1.25rem;">close</span>
                    </span>
                </div>
            @endif    
            
            @if ($archives->isEmpty())
                <p>No records found in the archive.</p>
            @else
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th style="text-align:center;">#</th>
                            <th style="text-align:center;">File Name</th>
                            <th style="text-align:center;">Archived Date</th>
                            <th style="text-align:center;">Archived By</th>
                            <th style="text-align:center;">Action</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($archives as $index => $archive)
                            <tr>
                                <td style="text-align:center;">{{ $index + 1 }}</td>
                                <td style="text-align:center;">{{ $archive->name }}</td>
                                <td style="text-align:center;">{{ $archive->archivedDate }}</td>
                                <td style="text-align:center;">{{ $archive->archivedBy }}</td>
                                <td style="display:flex; justify-content:center;">
                                    {{-- Add a button to trigger the delete action --}}
                                    <form id="deleteForm{{ $archive->id }}" action="{{ route('archive.delete', $archive->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm delete-button" data-archive-id="{{ $archive->id }}">
                                            <span class="material-symbols-outlined" style="color: darkred;">delete</span>
                                        </button>
                                    </form>
    
                                    {{-- Download button --}}
                                    <a href="{{ route('archive.butDownload', $archive->id) }}" class="btn btn-sm ml-3">
                                        <span class="material-symbols-outlined">download</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
    
            <dialog id="deleteDialog" class="bg-light p-4" style="border-radius: 10px; border: 1px solid #ddd; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                <p style="font-size: 16px; margin-bottom: 20px;">Are you sure you want to delete this archive data?</p>
                <button id="confirmDelete" style="background-color: #dc3545; color: #fff; border: none; padding: 8px 16px; margin-right: 10px; border-radius: 5px; cursor: pointer;">Yes, delete</button>
                <button id="cancelDelete" style="background-color: #ddd; color: #333; border: none; padding: 8px 16px; border-radius: 5px; cursor: pointer;">Cancel</button>
            </dialog>
    
        </div>
    
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            $(document).ready(function () {
                // Show the dialog on delete button click
                $('.delete-button').click(function () {
                    var archiveId = $(this).data('archive-id');
                    var dialog = document.getElementById('deleteDialog');

                    // Set up event listeners for the dialog buttons
                    document.getElementById('confirmDelete').onclick = function () {
                        // Manually trigger the form submission
                        document.getElementById('deleteForm' + archiveId).submit();
                        dialog.close();
                    };

                    document.getElementById('cancelDelete').onclick = function () {
                        dialog.close();
                    };

                    dialog.showModal();
                });
            });
        </script>
    
    </body>
    </html>
@else
    <p>You are not logged in.</p>
@endif