@extends('layouts.app') @section('title', 'Change Password') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Change Password') }}</div>
                <div id="success_errror_any">
                    @if (session('success'))
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-success alert-block" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ session('success') }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif @if (session('error'))
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger alert-block" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ session('error') }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif @if ($errors->any())
                    <div class="container-fluid">
                        <div class="alert alert-danger alert-block" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ url('/password') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="old_password">Old Password*</label>
                            <input id="old_password" name="old_password" type="password" class="form-control" value="{{ old('old_password') }}" autocomplete="first_name" placeholder="Enter Old Password" />
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password*</label>
                            <input id="new_password" name="new_password" type="password" class="form-control" value="{{ old('new_password') }}" placeholder="Enter New Password" autocomplete="new-password" />
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Confirm New Password*</label>
                            <input id="password-confirm" type="password" class="form-control" name="new_password_confirmation" placeholder="Re-Type New Password" autocomplete="new-password" />
                        </div>
                        <button type="button" class="btn btn-secondary btn-md" onclick="history.back()"><i class="fas fa-hand-point-left"></i> Go Back</button>
                        <button type="submit" class="btn btn-success btn-md"><i class="far fa-check-circle"></i> Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CONTAINER FLUID -->
<!--END CONTAINER FLUID-->

@endsection
