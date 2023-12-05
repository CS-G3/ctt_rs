@if(Auth::check())
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Insights</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    </head>
    <body class="d-flex bg-secondary">

        <!-- @include('components.responsive') -->
    
        @include('manager.sidenav')
    
        <div class="bg-light ml-1 p-4 w-100" style=" overflow-x: auto;">
    
            <h1>Insights</h1>
            <p style="color:grey;">Total student records: {{$studentCount}}</p>
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
            
        
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th style="text-align:center;">#</th>
                            <th style="text-align:center;">Placement</th>
                            <th style="text-align:center;">Total Student</th>
                            <th style="text-align:center;">Action</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($placements as $index => $item)
                            <tr>
                                <td style="text-align:center;">{{ $index + 1 }}</td>
                                <td style="text-align:center;">{{ $item->location }}</td>
                                <td style="text-align:center;">{{ $item->students_count }}</td>
                                <td style="text-align:center;">
                                <form action="{{ route('placement.delete') }}" method="POST" id="deleteForm">
                                    @csrf
                                    @method('DELETE')
                                    <input name="selectedPlacement" value="{{ $item->id }}" hidden>
                                    <button type="submit" class="btn btn-sm delete-button">
                                        <span class="material-symbols-outlined" style="color: darkred;">delete</span>
                                    </button>
                                </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <hr>

                <h3 class="mb-4">Number of students by placement</h3>

                <div>{!! $chart->container() !!}</div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                {!! $chart->script() !!}
                </div>
    
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    </body>
    </html>
@else
    <p>You are not logged in.</p>
@endif