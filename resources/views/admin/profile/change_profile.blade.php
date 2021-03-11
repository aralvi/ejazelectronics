@extends('layouts.admin')
@section('title', 'Profile | ')

@section('content')

<!-- CONTAINER FLUID -->
<div class="container-fluid">

	<!-- ROW 1 -->
    <div class="row  bg-light" style="border-radius: 10px;padding:10px;">
    	<div class="col-md-12">
    		@if ($profile->avatar != '')
	    		<img src="{{ asset('uploads/images/user/avatars/'.$profile->avatar)}}" style="width: 150px; height: 150px; float: left; border-radius: 50%; margin-right: 25px;">
	    	@else
	    		<img src="{{ asset('uploads/images/user/avatars/default.jpg')}}" style="width: 150px; height: 150px; float: left; border-radius: 50%; margin-right: 25px;">
	    	@endif
	        <h2 style="margin-top: 10px; padding:10px;">{{ $profile->name }}'s Profile</h2>
	        <form action="{{ url('admin/profile/change_avatar') }}" method="POST" enctype="multipart/form-data" style="margin-top: -15px;">
	        	@csrf
	        	<label>Update Profile Image</label>
	        	<br />
	        	<input type="file" name="avatar" accept="image/png, image/jpg, image/jpeg">
	        	<button style="float: right;" type="submit" class="btn btn-sm btn-primary">Update Image</button>
	        </form>
	    </div>
    </div>
    <!-- END ROW 1 -->
    <br />

	<div class="card">
		<div class="card-body">
			<form action="{{ url('admin/profile/'.$profile->id) }}" method="POST">
                @csrf
                @method('put')
				<div class="form-group">
				  	<label for="first_name">First Name*</label>
				  	<input id="first_name" name="name" type="text" class="form-control" value="{{ old('name') ?? $profile->name }}" autocomplete="first_name" placeholder="Enter First Name">

				</div>
				<div class="form-group">
				  	<label for="email">Email*</label>
				  	<input id="email" name="email" type="text" class="form-control" value="{{ old('email') ?? $profile->email }}" autocomplete="email" placeholder="Enter Email">

				</div>
				<button type="button" class="btn btn-secondary btn-md" onclick="history.back()"><i class="fas fa-hand-point-left"></i> Go Back</button>
                <button type="submit" class="btn btn-primary btn-md"><i class="far fa-check-circle"></i> Save Changes</button>
			</form>
		</div>
	</div>
	{{-- END CARD --}}

</div>
<!--END CONTAINER FLUID-->

@endsection
