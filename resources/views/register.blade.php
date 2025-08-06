<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</head>
<body>  

    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto mt-5 shadow rounded-3 p-5">
                <form action="{{route('register')}}" method="POST">
                    @csrf  

             @session('success') 
             <p class="text-primary">{{session('success')}}</p>
                 
             @endsession

                    <input type="text" class="form-control mb-3 mt-3" name="name" placeholder="Your Name">
                    @error('name') 

                    <p class="small text-danger">{{$message}}</p>
                        
                    @enderror

                    <input type="email" class="form-control  mb-3 mt-3" name="email" placeholder="Your Email">
                      @error('email') 

                    <p class="small text-danger">{{$message}}</p>
                        
                    @enderror


                    <input type="pasword" class="form-control  mb-3 mt-3" name="password" placeholder="Your Password">
                      @error('password') 

                    <p class="small text-danger">{{$message}}</p>
                        
                    @enderror

                    <button class="btn btn-secondary">Submit</button>
                </form>
            </div>
        </div>
    </div>


    
</body>
</html>