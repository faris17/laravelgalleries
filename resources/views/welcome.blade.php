<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <title>Gallery Image</title>
    <style>
        .btnDelete {
            position: absolute;
            top: 0;
            left: 0;
            border: 0px white solid !important;
            padding: 2px;
            opacity: 0.1;
            text-decoration: none
        }

        .btnDelete:hover {
            cursor: pointer;
            background-color: red;
            border-radius: 5px;
            transition: 0.5s;
            color: white;
            opacity: 1;
        }
    </style>
</head>

<body>
    <h1 class="text-center">Gallery</h1>

    <div class="container mt-10">
        <div class="col-md-12">
            <form id="submitUsers" method="post" action="{{ route('submit') }}" enctype="multipart/form-data">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label"></label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <input type="file" name="image" id="image" class="filepond" />
                    &nbsp;
                    <button type="submit" id="process" class='btn btn-primary btn-sm mt-2' style="height:40px"
                        name='submit'>Process</button>
                </div>
            </form>
            <hr>
        </div>
        <div id="resultPage" class="row d-flex justify-content-center">

        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    {{-- filepond library --}}
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>

    <script>
        var page = 1;
        //filepond here
        const inputFile = document.querySelector('input[id="image"]');
        // Create a FilePond instance
        const pond = FilePond.create(inputFile);
        //tujuan filepond
        FilePond.setOptions({
            server: {
                process: '{{ route('upload') }}', //upload
                revert: '{{ route('hapus') }}', //cancel
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        });

        //script jquery ajax
        $("#submitUsers").on('submit', function(e){
            e.preventDefault();
            $("#process").html('Processing...').attr('disabled', 'disabled');
                var link = $(this).attr('action');
                $.ajax({
                    url: link,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    type: "POST",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $("#process").html("Process").removeAttr('disabled');
                        $("#description").val(''); //textarea
                        if (response.status) {
                            pageImage(1);
                            pond.removeFiles(); //clear
                            // Display a success toast, with a title
                        } else {
                            alert('gagal');
                        }
                    },
                    error: function(response) {
                        $("#process").html("Process").removeAttr('disabled');
                        alert('gagal');
                    }
                });
        });

        pageImage(page);

        //load data listview
        function pageImage(page){
            $.ajax({
                    url: "{{ route('index.image') }}?page="+page,
                    success: function(response) {
                        $("#resultPage").html(response);
                    },
                    error: function(response) {
                        alert('gagal');
                    }
                });
        }

        //pagination click
        $(document).on('click', '.pagination a', function(e){
            e.preventDefault();
            page = $(this).attr('href').split('page=')[1];
            // alert(page);
            pageImage(page);

        });

        //delete function
        $(document).on('click', '.btnDelete', function(e){
            e.preventDefault();
            var linkDelete = $(this).attr('href');
            $.ajax({
                    url: linkDelete,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    type: "DELETE",
                    success: function(response) {
                        if (response.status) {
                            pageImage(page);
                        } else {
                            alert('gagal');
                        }
                    },
                    error: function(response) {
                        alert('error system');
                    }
                });
        })

    </script>

</body>

</html>
