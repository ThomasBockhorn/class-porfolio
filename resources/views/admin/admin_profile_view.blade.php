@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card"><br><br>
                        <div class="mx-auto">
                            <img class="img-fluid img-thumbnail" src="{{ (!empty($adminUser->profile_image))?
                               asset('upload/admin_images/' . $adminUser->profile_image):asset('upload/admin_images/no_image.jpg') }}" alt="Card image cap">
                        </div>

                        <div class="card-body">
                            <h4 class="card-title">Name : {{ $adminUser->name }} </h4>
                            <hr>
                            <h4 class="card-title">User Email : {{ $adminUser->email }} </h4>
                            <hr>
                            <a href="{{ route('edit.profile')  }}" class="btn btn-info btn-rounded waves-effect waves-light" > Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
