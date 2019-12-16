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
					<strong>Product Sub-Category</strong> 
				</div>
				<div class="card-body card-block">
					<form action="{{route('sub_category.store')}}" method="post" class="form-horizontal" style="border-bottom: solid;">
					@csrf

					<div class="row form-group">
						<div class="col col-md-3">
							<label for="hf-email" class=" form-control-label">Category Name</label>
						</div>
						<div class="col-12 col-md-9">
							<select name="category" id="category" class="form-control" required>
								<option selected="selected">--Please Select Category--</option>
								@foreach($categories as $category)
									<option value="{{$category->id}}">{{$category->category_name}}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="row form-group">
						<div class="col col-md-3">
							<label for="hf-email" class=" form-control-label">Sub-Category Name</label>
						</div>
						<div class="col-12 col-md-9">
							<div class="input-group">
								<input type="text" id="sub_category_name" name="sub_category_name" placeholder="Enter Sub-Category Name..." class="form-control" required>
								<div class="input-group-btn">
									<button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Add</button>
								</div>
							</div>
						</div>
					</div>

					</form>
					<br>
					<!-- table -->
					<table id="SCTable" class="table table-hover " style="width:100%;">
						<thead>
							<tr>
								<th width="40%">Category Name</th>
								<th width="40%">Sub-Category Name</th>
								<th width="20%">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($sub_categories as $sub_category)
							<tr>
								<td>{{$sub_category->category->category_name}}</td>
								<td>{{$sub_category->sub_category_name}}</td>
								<td>
									<button type="button" class="btn btn-primary btn-sm" id="CEdit" data-id="{{$sub_category->id}}" data-sub_category_name="{{$sub_category->sub_category_name}}" data-category_name="{{$sub_category->category->category_name}}">
										<i class="fa fa-edit"></i> Edit
									</button>
									<button type="button" class="btn btn-danger btn-sm" id = "CDestroy" data-id="{{$sub_category->id}}" data-sub_category_name="{{$sub_category->sub_category_name}}" data-category_name="{{$sub_category->category->category_name}}">
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

// start cedit
$('#CEdit[data-id]').on('click', function() {
	$('#EditModal').modal('show');
	$('#EditModalForm')[0].reset();
	$('input#category_name').val($(this).data('category_name'));
	$('input#sub_category_name').val($(this).data('sub_category_name'));
	$('input#id').val($(this).data('id'));
}); 
// end cedit click

// start CDestroy
$('#CDestroy[data-id]').on('click', function() {
	$('#DeleteModal').modal('show');
	$('#DeleteModalForm')[0].reset();
	$('label.DeleteConfirm').empty();
	$('label.DeleteConfirm').append('Are you sure you want to delete the <b>'+$(this).data('sub_category_name')+'</b> from '+$(this).data('category_name')+' category?');
	$('h5#mediumModalLabel').empty();
	$('h5#mediumModalLabel').append('Delete <b>'+$(this).data('sub_category_name')+' '+$(this).data('category_name')+'</b> ?');
	$('input#id').val($(this).data('id'));
});
// end cdelete

$('#SCTable').DataTable({     
	"aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 2 ] }, 
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
			<form action="{{route('sub_category.edit')}}" method="post" class="form-horizontal" id="EditModalForm">
			@csrf
				<div class="modal-header">
					<h5 class="modal-title" id="mediumModalLabel">Edit Sub-Category</h5>
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
								<input type="text" id="category_name" name="category_name" placeholder="Enter Category Name..." class="form-control" readonly="readonly">
							</div>
						</div>
					</div>

					<div class="row form-group">
						<div class="col col-md-3">
							<label for="hf-email" class=" form-control-label">Sub-Category Name</label>
						</div>
						<div class="col-12 col-md-9">
							<div class="input-group">
								<input type="text" id="sub_category_name" name="sub_category_name" placeholder="Enter Sub-Category Name..." class="form-control" required>
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
			<form action="{{route('sub_category.destroy')}}" method="post" class="form-horizontal" id="DeleteModalForm">
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
