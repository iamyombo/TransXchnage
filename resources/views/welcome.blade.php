<?php>

<!doctype html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class="container pt-6 mt-3">

    <div class="pb-3">
        <p class="h1 text-primary">Upload XML Files</p>
        <p>Select files for upload to be processed into database.</p>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
        <strong>{{ $message }}</strong>
        </div>

        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <form action="{{ route('uploadxml.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="col-6 colored"><input type="file" class="form-control" name="file" multiple/></div>
    <div class="pt-3"><button type="submit" class="btn btn-warning padding-top=5 ">Upload</button></div>
    <form>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>
