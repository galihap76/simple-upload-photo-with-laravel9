<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple Upload Photo With Laravel 9</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col h-100 d-flex align-items-center justify-content-center">
                <div class="card shadow p-3 mb-5 bg-body rounded border border-0">

                    @if ($message = Session::get('success'))
           
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    @endif
        
                    @foreach ($images as $img)
                         <img src="{{ asset('images/' . $img->image)}}" class="mx-auto d-block shadow p-3 mb-5 bg-body rounded rounded-circle " style="width:150px;">
                    @endforeach

                    @if (Session::has('message'))
                    <div class="alert alert-danger text-center">{{ Session::get('message') }}</div>

                    @elseif (Session::has('messageSuccess'))
                    <div class="alert alert-success text-center">{{ Session::get('messageSuccess') }}</div>
                    @endif

                    <form action="{{ route('image.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="inputImage">Image:</label>
                            <input type="file" name="image" id="inputImage" class="form-control @error('image') is-invalid @enderror">

                            @error('image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <div  class="text-center">
                                        <button type="submit" class="btn btn-success"><i class="bi bi-camera"></i> Upload</button>
                                    </div>
                                </div>
                            </div>       
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
