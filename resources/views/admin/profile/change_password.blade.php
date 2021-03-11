@extends('layouts.admin')

@section('title', 'Change Password | ')

@section('content')

<!-- CONTAINER FLUID -->
<div class="container-fluid">

	<!-- ROW 1 -->
    <div class="row">
    	<div class="col-md-6">
	        <h2 style="margin-top:4px;">Change Password</h2>
	    </div>
    </div>
    <!-- END ROW 1 -->
    <br />

	<div class="card">
		<div class="card-body">
			<form action="{{ url('admin/password') }}" method="POST">
				@csrf
				<div class="form-group">
				  	<label for="old_password">Old Password*</label>
				  	<input id="old_password" name="old_password" type="password" class="form-control " value="{{ old('old_password') }}" autocomplete="first_name" placeholder="Enter Old Password">

				</div>
				<div class="form-group">
				  	<label for="new_password">New Password*</label>
				  	<input id="new_password" name="new_password" type="password" class="form-control" value="{{ old('new_password') }}" placeholder="Enter New Password" autocomplete="new-password">

				</div>
				<div class="form-group">
				  	<label for="password-confirm">Confirm New Password*</label>
                	<input id="password-confirm" type="password" class="form-control" name="new_password_confirmation" placeholder="Re-Type New Password" autocomplete="new-password">
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
