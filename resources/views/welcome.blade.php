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
            <form id="submitUsers" method="post" action="" enctype="multipart/form-data">
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
            <div class="card m-2 col-md-2" style="padding:0px;">
                <img src="https://cdn.pixabay.com/photo/2020/03/03/20/31/boat-4899802_1280.jpg" class="card-img-top" width="100%"
                    alt="..." height="100%">
                <div class="card-body">
                    <p class="card-text"> Description Here</p>
                </div>
                <a class="btnDelete" href="">
                    Delete
                </a>
            </div>
            <div class="card m-2 col-md-2" style="padding:0px;">
                <img src="https://cdn.pixabay.com/photo/2015/02/18/11/50/mountain-range-640617_1280.jpg" class="card-img-top" width="100%"
                    alt="..." height="100%">
                <div class="card-body">
                    <p class="card-text"> Description Here</p>
                </div>
                <a class="btnDelete" href="">
                    Delete
                </a>
            </div>
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

</body>

</html>
