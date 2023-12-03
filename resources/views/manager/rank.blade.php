@if(Auth::check())
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rank</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="{{ asset('css/components.css') }}"> -->
     <!-- google symbols -->
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
        button {
            background-color: #73AF42;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 12px;
        }

        .hidden {
            display: none;
        }

        input {
            width: 70%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .large-modal .modal-dialog {
            max-width: 80%;
            margin-top: 10rem;
        }

        table tr td input {
            width:50px;
            text-align:center;
            border:none;
            color: grey;
        }

    </style>
</head>
<body class="d-flex bg-secondary">

@include('components.responsive')

@include('manager.sidenav')

<div class="bg-light ml-1 p-4 w-100"  style="overflow:auto; height:100vh;">

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
    
    <div class="container">
        <div class="row">

            <div class="col-md-2">
                <select id="tableSelector" class="form-control">
                    <option value="table1" selected>SOC</option>
                    <option value="table2">SIDD</option>
                </select>
            </div>

            <div class="col-md-3">
                <button id="setupCriteria" data-toggle="modal" data-target="#criteriaModal" 
                style="display: flex; justify-content: center; align-items: center;">
                    <i class='bx bx-cog' style="font-size: 18px; margin-right: 5px;"></i>
                    <span style="font-size: 14px;">Setup Criteria</span>
                </button>
            </div>

            <div class="col-md-4" style="display: flex;">
                    <input type="text" id="searchInput" placeholder="Search" 
                    style="margin-right: 10px; border-radius:5px; border:none; background-color:lightgrey; padding: 5px 10px;">
                    <button id="searchButton" 
                    style="background-color: #73AF42; color: #fff; border: none; border-radius: 3px; padding: 10px 20px; cursor: pointer;"
                    >
                        Search
                    </button>
             </div>

            <div class="col-md-3">
                <form id="uploadForm" action="{{ route('import.csv') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" id="fileInput" accept=".csv, .xls, .xlsx" required style="display: none;">
                    <button id="fileButton" style="display: flex; justify-content: center; align-items: center;">
                        <i class='bx bx-upload' style="font-size: 20px; margin-right: 5px;"></i>
                        <span style="font-size: 14px; margin-left:0.2rem;">Upload a File</span>
                    </button>
                </form>
                <!-- <form id="rankStudentsForm" action="{{ route('rankStudents') }}" method="POST" style="display: none;">
                    @csrf
                </form> -->
            </div>
            
        </div>
    </div>

<div class="modal fade large-modal" id="criteriaModal" tabindex="-1" role="dialog" aria-labelledby="criteriaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="criteriaModalLabel">Subject Multiplier</h5>
            </div>
            <div class="modal-body">

            @php
                // Assuming $criteria is an associative array with column names as keys
                $criteria = [
                    'mat' => 'Mathematics',
                    'bmt' => 'Business Mathematics',
                    'eng' => 'English',
                    'phy' => 'Physics',
                    'che' => 'Chemistry',
                    'bio' => 'Biology',
                    'dzo' => 'Dzongkha',
                    'com' => 'Commerce',
                    'acc' => 'Accounting',
                    'geo' => 'Geography',
                    'his' => 'History',
                    'eco' => 'Economics',
                    'med' => 'Media',
                    'bent' => '',
                    'evs' => 'Environmental Science',
                    'rige' => 'Rigzhung',
                    'agfs' => 'Agricultural Science',
                ];
            @endphp

            <form action="{{ route('update-ranking-criteria') }}" id="criteriaForm" method="post">
            @csrf
            <div id="messageContainer" class="text-center"></div>

            <table>
                <tr style="background-color:#fff">
                    <!-- <td style="padding:5px; font-weight:500">Subject</td> -->
                    @foreach ($criteria as $column => $subject)
                        <td style="padding:5px;">{{ strtoupper($column) }}</td>
                    @endforeach
                </tr>
                <tr style="background-color:#EDEDED;">
                    <!-- <td style="padding:5px; font-weight:500">Multiplier</td> -->
                    @foreach ($criteria as $column => $subject)
                        <td style="padding:5px;">
                            <input id="{{ $column }}" name="{{ $column }}" value="{{ $rankingCriteria->{$column} }}">
                        </td>
                    @endforeach
                </tr>
            </table>

            <div class="modal-footer">
                <button type="button" 
                style="background-color: #ddd; color: #333; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;"
                 data-dismiss="modal">Close</button>
                <button type="submit">Update</button>
            </div>
        </form>

            </div>
        </div>
    </div>
</div>

    <!-- <div id="tableContainer" class="" style="height:70vh"></div> -->
    <div id="tableContainer" class="" style="height:70vh">
        @if(empty($data))
            <div class="alert alert-info mt-5">No data available. Please upload a file to continue.</div>
        @else
            <!-- {!! $dataFromServer !!} -->
        @endif
    </div>
    
   <a href="{{ ('/manager/add-student') }}" style="color:#fff"> 
        <button> Add Student</button>
    </a>

    <!-- Button to open the dialog box -->
    <button onclick="openDialog()">Save</button>

    <!-- The dialog box -->
    <dialog id="saveDialog" style="border-radius: 10px; padding: 1rem;
    border: 1px solid #ddd; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">

        <div id="saveOptions">
            <p>Choose either to download or archive the result.</p>

            <div style="display:flex; justify-content: space-between;">
            <form action="{{ route('archive.download') }}" method="GET">
                    @csrf
                <button onclick="buttonOneAction()">Download All Records</button>
            </form>
            
            <button id="showModalButton">Archive</button>
            <button onclick="closeDialog()"
            style="background-color: #ddd; color: #333; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Cancel</button>
            </div>
        </div>
    
        <div id="archiveModal" style="display: none;">
            <form id="archiveForm" action="{{ route('archive.save') }}" method="POST">
                @csrf
                <label for="file_name">File Name:</label>
                <input type="text" name="file_name" id="file_name" class="form-control" placeholder="Enter a file name"
                style="margin-right: 10px; border-radius:5px; border:none; background-color:lightgrey; padding: 5px 10px; margin-bottom:1rem;">

                <div style="display:flex; justify-content: space-between;">
                    <button type="submit">Archive</button>
                    <button onclick="closeDialog()" type="button"
                    style="background-color: #ddd; color: #333; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Cancel</button>
                </div>
            </form>
        </div>

    </dialog>

    <!-- <div>
        <button id="mainButton" onclick="toggleButtons()">Save</button>

        <div id="additionalButtons" class="hidden">
           
        </div> -->
    </div>

    <script>
    // Function to open the dialog box
    function openDialog() {
            // Get the dialog element
            var dialog = document.getElementById('saveDialog');

            // Open the dialog box
            dialog.showModal();
        }

        // Function to close the dialog box
        function closeDialog() {
            // Get the dialog element
            var dialog = document.getElementById('saveDialog');

            // Close the dialog box
            dialog.close();
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- handle file upload --}}
    <script>
        document.getElementById('fileButton').addEventListener('click', function() {
            document.getElementById('fileInput').click();
        });
    
        // Optional: If you want to display the chosen file's name after selection
        document.getElementById('fileInput').addEventListener('change', function() {
            const fileInput = document.getElementById('fileInput');
            if (fileInput.files.length > 0) {
                const fileName = fileInput.files[0].name;
                // Display the selected file name or perform any other actions
                console.log('Selected file:', fileName);
            }
        });
    </script>

<script>
// function toggleButtons() {
//     var additionalButtons = document.getElementById('additionalButtons');

//     // Toggle the 'hidden' class to show/hide the additional buttons
//     if (additionalButtons.style.display === 'none' || additionalButtons.style.display === '') {
//         additionalButtons.style.display = 'block';
//     } else {
//         additionalButtons.style.display = 'none';
//     }
// }

document.getElementById('showModalButton').addEventListener('click', function() {
    document.getElementById('archiveModal').style.display = 'block';
    document.getElementById('saveOptions').style.display = 'none';
});

// Optional: You might want to close the modal after form submission
document.getElementById('archiveForm').addEventListener('submit', function() {
    document.getElementById('archiveModal').style.display = 'none';
});

    //Table selector 
    $(document).ready(function () {
    $('#tableSelector').on('change', function () {
        var selectedTable = $(this).val();
        if (selectedTable) {
            // Use AJAX to load the selected table
            $.get('/load-table/' + selectedTable, function (data) {
                $('#tableContainer').html(data);
            });
        } else {
            $('#tableContainer').empty();
        }
    });

    // Trigger the change event to load the default table
    $('#tableSelector').trigger('change');
});

//File uploader and ranker
$(document).ready(function () {
        $('input[type="file"]').change(function () {
            // Check if a file has been selected
            if (this.files && this.files[0]) {
                // Submit the form
                $('#uploadForm').submit();
            }
        });
    });

    $(document).ready(function () {
    $('#criteriaForm').submit(function (event) {
        event.preventDefault(); // Prevent the default form submission

        // Serialize the form data
        var formData = $(this).serialize();

        // Perform an AJAX request to submit the form data
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            success: function (response) {
                // Display a success message in the modal
                $('#messageContainer').html('<div class="alert alert-success">Multiplier updated successfully.</div>');
            },
            error: function (xhr, status, error) {
                // Display an error message in the modal
                $('#messageContainer').html('<div class="alert alert-danger">"File upload failed"</div>');
            }
        });
    });
});

$(document).ready(function () {
    // Attach a click event to the "Upload File and Rank Students" button
    $('#uploadSubmit').on('click', function () {
        // Perform an AJAX request to submit the file upload form
        $.ajax({
            type: 'POST',
            url: $('#uploadForm').attr('action'),
            data: new FormData($('#uploadForm')[0]),
            contentType: false,
            processData: false,
            success: function () {
                // Once the upload is successful, submit the ranking form
                $('#rankStudentsForm').submit();
            },
            error: function () {
                // Handle errors, e.g., show an error message
                alert('Error uploading the file');
            }
        });
    });
});

</script>
</body>

@else
    <p>You are not logged in.</p>
@endif
</html>
