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
    </style>
</head>
<body class="d-flex bg-secondary">

@include('manager.sidenav')

<div class="bg-light ml-1 p-4 w-100"  style="overflow:auto; height:100vh;">

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
                    <input type="text" id="searchInput" placeholder="Enter your search query" 
                    style="margin-right: 10px; border-radius:5px; border:none; background-color:lightgrey; padding: 5px;">
                    <button id="searchButton" style="background-color: #73AF42; color: #fff; border: none; border-radius: 3px; padding: 10px 20px; cursor: pointer;">
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

<div class="modal fade" id="criteriaModal" tabindex="-1" role="dialog" aria-labelledby="criteriaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="criteriaModalLabel">Subject Multiplier</h5>
            </div>
            <div class="modal-body">
               
                <form action="{{ route('update-ranking-criteria') }}" id="criteriaForm" method="post">
                    @csrf
                    <div id="messageContainer" class="text-center"></div>

                    <div class="col-md-3">
                        <input type="text" name="eng" placeholder="eng"><br>
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="eng" placeholder="eng"><br>
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="eng" placeholder="eng"><br>
                    </div>
                    
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

    <div id="tableContainer" class="" style="height:70vh"></div>

    
    <button><a href="{{ ('/manager/add-student') }}" style="color:#fff"> Add Student</a></button>

    <!-- Button to open the dialog box -->
    <button onclick="openDialog()">Save</button>

    <!-- The dialog box -->
    <dialog id="saveDialog">
        <p>This is a simple dialog box.</p>
        <form action="{{ route('archive.download') }}" method="GET">
                @csrf
            <button onclick="buttonOneAction()">Download</button>
        </form>
        
        <button id="showModalButton">Archive</button>

        <button onclick="closeDialog()">Close</button>
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
// document.getElementById('showModalButton').addEventListener('click', function() {
//     document.getElementById('archiveModal').style.display = 'block';
// });

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

@else
    <p>You are not logged in.</p>
@endif
</html>
