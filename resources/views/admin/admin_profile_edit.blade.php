@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card"><br><br>
                        <h1 class="text-center">Edit Profile</h1>
                        <div class="card-body">
                            <form action = "">
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input class="form-control" id="name" name="name" type="text" required autofocus placeholder="{{ $adminUser->name  }}">
                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input id="email" class="form-control" type="email" required name="email" placeholder="{{ $adminUser->email }}">
                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input id="image" class="form-control" type="file" required name="email">
                                    </div>
                                </div>
                                <div class="mx-auto mb-5">
                                    <img id="showImage" class="img-fluid img-thumbnail" src="{{ asset('backend/assets/images/small/img-5.jpg') }}" alt="Card image cap">
                                </div>
                                <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light" >Submit Edit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#image').change(function(e){
                let reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0'])
            })
        })
    </script>

@endsection
