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
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body class="d-flex bg-secondary">

@include('manager.sidenav')

<div class="bg-light ml-1 p-4 w-100">

    
    
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif
    
    @else
        <p>You are not logged in.</p>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <select id="tableSelector" class="form-control">
                    <option value="table1" selected>SOC</option>
                    <option value="table2">SIDD</option>
                    <!-- Add more options for each table -->
                </select>
            </div>
            <div class="col-md-2">
                <button id="setupCriteria" class="btn btn-primary" data-toggle="modal" data-target="#criteriaModal">Setup Criteria</button>
            </div>
            <div class="col-md-4">
                <input type="number" id="searchInput" class="form-control" placeholder="Enter your search query">
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <form id="uploadForm" action="{{ route('import.csv') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" accept=".csv, .xls, .xlsx" required>
                </form>
                <form id="rankStudentsForm" action="{{ route('rankStudents') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    

            <!-- Modal -->
<div class="modal fade" id="criteriaModal" tabindex="-1" role="dialog" aria-labelledby="criteriaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="criteriaModalLabel">Subject Weightage</h5>
            </div>
            <div class="modal-body">
                
                <form action="{{ route('update-ranking-criteria') }}" id="criteriaForm" method="post">
                    @csrf
                    <div id="messageContainer" class="text-center"></div>
                    {{-- <input type="text" name="ranking_criteria_id" placeholder="Year"><br> --}}
                    <input type="text" name="eng" placeholder="eng"><br>
                    <input type="text" name="dzo" placeholder="dzo"><br>
                    <input type="text" name="com" placeholder="com"><br>
                    <input type="text" name="acc" placeholder="acc"><br>
                    <input type="text" name="bmt" placeholder="bmt"><br>
                    <input type="text" name="geo" placeholder="geo"><br>
                    <input type="text" name="his" placeholder="his"><br>
                    <input type="text" name="eco" placeholder="eco"><br>
                    <input type="text" name="med" placeholder="med"><br>
                    <input type="text" name="bent" placeholder="bent"><br>
                    <input type="text" name="evs" placeholder="evs"><br>
                    <input type="text" name="rige" placeholder="rige"><br>
                    <input type="text" name="agfs" placeholder="agfs"><br>
                    <input type="text" name="mat" placeholder="mat"><br>
                    <input type="text" name="phy" placeholder="phy"><br>
                    <input type="text" name="che" placeholder="che"><br>
                    <input type="text" name="bio" placeholder="bio"><br>
                    <input type="text" name="socT" placeholder="Soc total students"><br>
                    <input type="text" name="siddT" placeholder="SIDD total students"><br>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" value="Submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>

<div id="archiveModal" style="display: none;">
    <form id="archiveForm" action="{{ route('archive.save') }}" method="POST">
        @csrf
        <label for="file_name">File Name:</label>
        <input type="text" name="file_name" id="file_name">
        <button type="submit">Save CSV</button>
    </form>
</div>
    <div id="tableContainer" class="table-container "></div>
    <div>
        <button id="addNew">Add new row data</button>
    </div>

    <div>
        <button id="mainButton" onclick="toggleButtons()">Save</button>

        <div id="additionalButtons" class="hidden">
            <button onclick="buttonOneAction()">Download</button>
            <button id="showModalButton">Archive</button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function toggleButtons() {
    var additionalButtons = document.getElementById('additionalButtons');

    // Toggle the 'hidden' class to show/hide the additional buttons
    if (additionalButtons.style.display === 'none' || additionalButtons.style.display === '') {
        additionalButtons.style.display = 'block';
    } else {
        additionalButtons.style.display = 'none';
    }
}

function buttonOneAction() {
    $.ajax({
            url: '/download', // Adjust the URL based on your route
            type: 'GET',
            error: function(error) {
                console.error('Error:', error);
            }
        });
}

document.getElementById('showModalButton').addEventListener('click', function() {
    document.getElementById('archiveModal').style.display = 'block';
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
                $('#messageContainer').html('<div class="alert alert-success">Data updated or inserted successfully</div>');
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

</html>
