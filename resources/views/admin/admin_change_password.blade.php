@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card"><br><br>
                        <h1 class="text-center">Change Password</h1>
                        <div class="card-body">

                            @if(count($errors))
                                @foreach($errors->all() as $error)
                                    <p class="alert alert-danger alert-dismissible fade show">{{ $error }}</p>
                                @endforeach
                            @endif

                            <form method="post" action="{{ route('store.password') }}">
                                @csrf
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input class="form-control" id="oldpassword" name="old_password" type="password" placeholder="Old Password">
                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input id="password" class="form-control" type="password" name="new_password" placeholder="New Password">
                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input id="confirm_password" class="form-control" type="password" name="confirm_password" placeholder="Confirm Password">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light" >Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
