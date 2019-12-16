@extends('index')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
			@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif

			@if(session('success'))
			    <div class="alert alert-success">
			    	{{session('success')}}
				</div>
			@endif
			<!-- account -->
			<div class="card">
				<div class="card-header">
					<strong>Accounts</strong> 
				</div>
				<div class="card-body card-block">
					<!-- table -->
					<table id="ATable" class="table table-hover " style="width:100%;">
						<thead>
							<tr>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Username</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($users as $user)
							<tr>
								<td>{{$user->first_name}}</td>
								<td>{{$user->last_name}}</td>
								<td>{{$user->username}}</td>
								<td>
									<button class="btn btn-primary btn-sm" id="AEdit" data-id = "{{$user->id}}"><span class="fa fa-edit">&nbsp;</span>Edit</button>

									<!-- <button class="btn btn-primary btn-sm" id="AEdit" data-id = "{{$user->id}}" data-first_name = "{{$user->first_name}}" data-last_name = "{{$user->last_name}}" data-username = "{{$user->username}}"><span class="fa fa-edit">&nbsp;</span>Edit</button> -->
									
									@if(Auth::id() == $user->id)
										<button class="btn btn-info btn-sm" id="AChangePass" data-id = "{{$user->id}}" data-first_name = "{{$user->first_name}}" data-last_name = "{{$user->last_name}}" data-username = "{{$user->username}}"><span class="fa fa-lock">&nbsp;</span>Change Password</button>
									@else
										@if($user->active == 0)
											<button class="btn btn-success btn-sm" id="Aactivate" data-id = "{{$user->id}}" data-first_name = "{{$user->first_name}}" data-last_name = "{{$user->last_name}}" data-username = "{{$user->username}}"><span class="fa fa-check">&nbsp;</span>Activate</button>
										@else
											<button class="btn btn-danger btn-sm" id="Adeactivate" data-id = "{{$user->id}}" data-first_name = "{{$user->first_name}}" data-last_name = "{{$user->last_name}}" data-username = "{{$user->username}}"><span class="fa fa-times">&nbsp;</span>Deactivate</button>
										@endif
										<button class="btn btn-info btn-sm" id="AresetPass" data-id = "{{$user->id}}" data-first_name = "{{$user->first_name}}" data-last_name = "{{$user->last_name}}" data-username = "{{$user->username}}"><span class="fa fa-lock">&nbsp;</span>Reset Password</button>
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<!-- end table -->
				</div>
			</div>
			<!-- end Category -->
        </div>
    </div>
</div>


@endsection

@section('css')
<link rel="stylesheet" href="{{asset('datatable/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('datatable/dataTables.bootstrap4.min.css')}}">
@endsection

@section('Js')
<script src="{{asset('datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('datatable/dataTables.bootstrap4.min.js')}}"></script>

<script>
$( document ).ready(function() {

$('.alert').delay(5000).fadeOut('slow');

// start AEdit
$('#AEdit[data-id]').on('click', function() {
	$.ajax({
		type: "POST",
		url: "{{route('account.GetUserInfo')}}",
		data: {
			id: $(this).data('id'),
		},
		success: function(data){
			console.log(data);
			$('#EditModal').modal('show');
			$('#EditModalForm')[0].reset();
			$('input#first_name').val(data.first_name);
			$('input#last_name').val(data.last_name);
			$('input#username').val(data.username);
			$('input#id').val(data.id);

		},
		errors: function(data){
			console.log(data);
		},
	});


}); 
// end AEdit click

// start Adeactivate
$('#Aactivate[data-id]').on('click', function() {
	$('#ActivateModal').modal('show');
	$('#ActivateModalForm')[0].reset();
	$('input#id').val($(this).data('id'));
	$('input#active').val(1);
	$('input#action').val('Activated');

	$('#Activatebtnclass').removeClass().addClass('btn btn-success');

	$('#actionfa').removeClass().addClass("fa fa-check");
	$('#ActivatemediumModalLabel').empty();
	$('#ActivatemediumModalLabel').append('Activate User');
	$('#actiontext').empty();
	$('#actiontext').append('Activate');
	$('#questionaction').empty();
	$('#questionaction').append('<b>activate</b> ' + $(this).data('first_name') + ' ' + $(this).data('last_name') + '?');
}); 
// end Adeactivate click

// start Adeactivate
$('#Adeactivate[data-id]').on('click', function() {
	$('#ActivateModal').modal('show');
	$('#ActivateModalForm')[0].reset();
	$('input#id').val($(this).data('id'));
	$('input#active').val(0);
	$('input#action').val('Deactivated');

	$('#Activatebtnclass').removeClass().addClass('btn btn-danger');

	$('#actionfa').removeClass().addClass("fa fa-times");
	$('#ActivatemediumModalLabel').empty();
	$('#ActivatemediumModalLabel').append('Deactivate User');
	$('#actiontext').empty();
	$('#actiontext').append('Deactivate');
	$('#questionaction').empty();
	$('#questionaction').append('<b>deactivate</b> ' + $(this).data('first_name') + ' ' + $(this).data('last_name') + '?');
}); 
// end Adeactivate click

// start AChangePass
$('#AChangePass[data-id]').on('click', function() {
	$('#PasswordModal').modal('show');
	$('#PasswordModalForm')[0].reset();
	$('input#id').val($(this).data('id'));
}); 
// end AChangePass click

// start AChangePass
$('#AresetPass[data-id]').on('click', function() {
	$('#ResetModal').modal('show');
	$('#ResetModalForm')[0].reset();
	$('input#id').val($(this).data('id'));

	$('#fullname').empty();
	$('#fullname').append($(this).data('first_name') + ' ' + $(this).data('last_name'));

}); 
// end AChangePass click

$('#ATable').DataTable({     
	"aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 3 ] }, 
    ]
});

}); //end ready
</script>
@endsection

@section('modal')

<!-- ResetModal  -->
<div class="modal fade" id="ResetModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form action="{{route('account.reset')}}" method="post" class="form-horizontal" id="ResetModalForm">
			@csrf
				<div class="modal-header">
					<h5 class="modal-title" id="mediumModalLabel">Reset Password</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id = "id" name="id">
					<input type="hidden" id = "action" name="action">
					<input type="hidden" id = "active" name="active">
					<div class="container">
						Reset Password the of <b><span id="fullname"></span></b>?<br>
						<small>The new password will be <b>123456</b></small>
					</div>
					
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-info"><i class="fa fa-lock"></i> Reset Password</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- end ResetModal  -->

<!-- PasswordModal  -->
<div class="modal fade" id="PasswordModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form action="{{route('account.password')}}" method="post" class="form-horizontal" id="PasswordModalForm">
			@csrf
				<div class="modal-header">
					<h5 class="modal-title" id="mediumModalLabel">Change Password</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id = "id" name="id">

					<div class="row form-group">
						<div class="col col-md-4">
							<label for="hf-email" class=" form-control-label">Current Password</label>
						</div>
						<div class="col-12 col-md-8">
							<div class="input-group">
								<input type="password" id="current_password" name="current_password" placeholder="Enter Current Password..." class="form-control" required>
							</div>
						</div>
					</div>

					<div class="row form-group">
						<div class="col col-md-4">
							<label for="hf-email" class=" form-control-label">New Password</label>
						</div>
						<div class="col-12 col-md-8">
							<div class="input-group">
								<input type="password" id="new-password" name="new-password" placeholder="Enter New Password..." class="form-control" required>
							</div>
						</div>
					</div>

					<div class="row form-group">
						<div class="col col-md-4">
							<label for="hf-email" class=" form-control-label">Confirm New Password</label>
						</div>
						<div class="col-12 col-md-8">
							<div class="input-group">
								<input type="password" id="new-password_confirmation" name="new-password_confirmation" placeholder="Confirm New Password..." class="form-control" required>
							</div>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-info"><i class="fa fa-lock"></i> Change Password</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- end PasswordModal  -->

<!-- ActivateModal  -->
<div class="modal fade" id="ActivateModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form action="{{route('account.activate')}}" method="post" class="form-horizontal" id="ActivateModalForm">
			@csrf
				<div class="modal-header">
					<h5 class="modal-title" id="ActivatemediumModalLabel"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id = "id" name="id">
					<input type="hidden" id = "action" name="action">
					<input type="hidden" id = "active" name="active">
					
					Are you sure you want to <span id="questionaction"></span>

				</div>
				<div class="modal-footer">
					<button type="submit" id="Activatebtnclass"><i id="actionfa"></i> <span id="actiontext"></span></button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- end ActivateModal  -->

<!-- EditModal  -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form action="{{route('account.edit')}}" method="post" class="form-horizontal" id="EditModalForm" enctype="multipart/form-data">
			@csrf
				<div class="modal-header">
					<h5 class="modal-title" id="mediumModalLabel">Edit Account Information</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id = "id" name="id">
					
					<div class="row form-group">
						<div class="col col-md-3">
							<label for="hf-email" class=" form-control-label">First Name</label>
						</div>
						<div class="col-12 col-md-9">
							<div class="input-group">
								<input type="text" id="first_name" name="first_name" placeholder="Enter First Name..." class="form-control" required>
							</div>
						</div>
					</div>
					
					<div class="row form-group">
						<div class="col col-md-3">
							<label for="hf-email" class=" form-control-label">Last Name</label>
						</div>
						<div class="col-12 col-md-9">
							<div class="input-group">
								<input type="text" id="last_name" name="last_name" placeholder="Enter Last Name..." class="form-control" required>
							</div>
						</div>
					</div>
					
					<div class="row form-group">
						<div class="col col-md-3">
							<label for="hf-email" class=" form-control-label">Username</label>
						</div>
						<div class="col-12 col-md-9">
							<div class="input-group">
								<input type="text" id="username" name="username" placeholder="Enter Username..." class="form-control" required>
							</div>
						</div>
					</div>

					<div class="row form-group">
						<div class="col col-md-3">
							<label for="hf-email" class=" form-control-label">Profile Picture</label>
						</div>
						<div class="col-12 col-md-9">
							<div class="input-group">
								<input type="file" name="image" class="form-control-file" />
							</div>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- end EditModal  -->

@endsection
