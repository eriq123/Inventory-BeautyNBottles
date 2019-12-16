@extends('index')

@section('content')
@role('Admin|Assistant')
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
			<!-- Category -->
			<div class="card">
				<div class="card-header">
					<strong>Product Category</strong> 
				</div>
				<div class="card-body card-block">
					<form action="{{route('category.store')}}" method="post" class="form-horizontal" style="border-bottom: solid;">
					@csrf
						<div class="row form-group">
							<div class="col col-md-3">
								<label for="hf-email" class=" form-control-label">Category Name</label>
							</div>
							<div class="col-12 col-md-9">
								<div class="input-group">
									<input type="text" id="category_name" name="category_name" placeholder="Enter Category Name..." class="form-control" required>
									<div class="input-group-btn">
										<button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Add</button>
									</div>
								</div>
							</div>
						</div>
					</form>
					<br>
					<!-- table -->
					<table id="CTable" class="table table-hover " style="width:100%;">
						<thead>
							<tr>
								<!-- <th width="15%">id</th> -->
								<th width="50%">Name</th>
								<th width="50%">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($categories as $category)
							<tr>
								<!-- <td>{{--$category->id--}}</td> -->
								<td>{{$category->category_name}}</td>
								<td>
									<button type="button" class="btn btn-primary btn-sm" id="CEdit" data-id="{{$category->id}}" data-name="{{$category->category_name}}">
										<i class="fa fa-edit"></i> Edit
									</button>
									<button type="button" class="btn btn-danger btn-sm" id = "CDestroy" data-id="{{$category->id}}" data-name="{{$category->category_name}}">
										<i class="fa fa-times"></i> Delete
									</button>
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


@endrole
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

$('.alert').delay(2000).fadeOut('slow');

// // start cedit
$('#CEdit[data-id]').on('click', function() {
	$('#EditModal').modal('show');
	$('#EditModalForm')[0].reset();
	$('input#category_name').val($(this).data('name'));
	$('input#id').val($(this).data('id'));
}); 
// end cedit click

// start CDestroy
$('#CDestroy[data-id]').on('click', function() {
	$('#DeleteModal').modal('show');
	$('#DeleteModalForm')[0].reset();
	$('label.DeleteConfirm').empty();
	$('label.DeleteConfirm').append('Are you sure you want to delete the <b>'+$(this).data('name')+'</b> category?');
	$('h5#mediumModalLabel').empty();
	$('h5#mediumModalLabel').append('Delete <b>'+$(this).data('name')+'</b> ?');
	$('input#id').val($(this).data('id'));
	
// category.destroy
});
// end cdelete

$('#CTable').DataTable({     
	"aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 1 ] }, 
    ]
});

}); //end ready
</script>
@endsection

@section('modal')
<!-- edit  -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form action="{{route('category.edit')}}" method="post" class="form-horizontal" id="EditModalForm">
			@csrf
				<div class="modal-header">
					<h5 class="modal-title" id="mediumModalLabel">Edit Category</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="row form-group">
						<div class="col col-md-3">
							<label for="hf-email" class=" form-control-label">Category Name</label>
						</div>
						<div class="col-12 col-md-9">
							<div class="input-group">
								<input type="text" id="category_name" name="category_name" placeholder="Enter Category Name..." class="form-control" required>
								<input type="hidden" id = "id" name="id">
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
<!-- end edit  -->

<!-- delete  -->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form action="{{route('category.destroy')}}" method="post" class="form-horizontal" id="DeleteModalForm">
			@csrf
				<div class="modal-header">
					<h5 class="modal-title" id="mediumModalLabel"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row form-group">
						<div class="col-12">
							<label class=" form-control-label DeleteConfirm"></label>
							<input type="hidden" id = "id" name="id">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger"><i class="fa fa-times"></i> Delete</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- end delete  -->

@endsection
