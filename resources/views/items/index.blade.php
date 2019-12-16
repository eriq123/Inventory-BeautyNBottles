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
			<!-- add product -->
			<div class="card">
				<form action="{{route('item.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
				@csrf
				<div class="card-header">
					<strong>Add Products</strong> 
				</div>
				<div class="card-body card-block">

					<!-- name -->
					<div class="row form-group">
						<div class="col col-md-3">
							<label for="hf-email" class=" form-control-label">Product Name<span class="asterisk"> *</span></label>
						</div>
						<div class="col-12 col-md-9">
							<input type="text" id="item_name" name="item_name" placeholder="Enter Product Name..." class="form-control" required>
						</div>
					</div>
					<!-- description -->
					<div class="row form-group">
                        <div class="col col-md-3">
                            <label for="textarea-input" class=" form-control-label">Product Description<span class="asterisk"> *</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <textarea id="item_description" name="item_description" rows="4" placeholder="Enter Product Description..." class="form-control" value="{{old('item_description')}}" required></textarea>
                        </div>
                    </div>

					<!-- category -->
					<div class="row form-group">
						<div class="col col-md-3">
							<label for="hf-email" class=" form-control-label">Category<span class="asterisk"> *</span></label>
						</div>
						<div class="col-12 col-md-9">
							<select name="category" id="category" class="form-control" required>
								<option selected="selected"></option>
								@foreach($categories as $category)
									<option value="{{$category->id}}">{{$category->category_name}}</option>
								@endforeach
							</select>
						</div>
					</div>												

					<!-- sub category -->
					<div class="row form-group">
						<div class="col col-md-3">
							<label for="hf-email" class=" form-control-label">Sub-Category</label>
						</div>
						<div class="col-12 col-md-9">
							<select name="sub_category" id="sub_category" class="form-control">
								<option selected="selected"></option>
							</select>
						</div>
					</div>

					<!-- quantity -->
					<div class="row form-group">
                        <div class="col col-md-3">
                            <label for="textarea-input" class=" form-control-label">Quantity<span class="asterisk"> *</span></label>
                        </div>
                        <div class="col-12 col-md-9">
							<input type="text" id="quantity" name="quantity" placeholder="Enter Quantity..." class="form-control" value="{{old('quantity')}}" required>
                        </div>
                    </div>

                    <!-- unit -->
					<div class="row form-group">
                        <div class="col col-md-3">
                            <label for="textarea-input" class=" form-control-label">Unit<span class="asterisk"> *</span></label>
                        </div>
                        <div class="col-12 col-md-9">
							<input type="text" id="unit" name="unit" placeholder="Enter Unit..." class="form-control" value="{{old('unit')}}" required>
                        </div>
                    </div>

                    <!-- limit -->
					<div class="row form-group">
                        <div class="col col-md-3">
                            <label for="textarea-input" class=" form-control-label">Limit<span class="asterisk"> *</span></label>
                        </div>
                        <div class="col-12 col-md-9">
							<input type="text" id="limit" name="limit" placeholder="Enter Product Limit..." class="form-control" value="{{old('limit')}}" required>
                        </div>
                    </div>

                    <!-- selling_price -->
					<div class="row form-group">
                        <div class="col col-md-3">
                            <label for="textarea-input" class=" form-control-label" >Selling Price<span class="asterisk"> *</span></label>
                        </div>
                        <div class="col-12 col-md-9">
							<input type="text" id="selling_price" name="selling_price" placeholder="Enter Selling Price..." class="form-control" value="{{old('selling_price')}}" required>
                        </div>
                    </div>

                    <!-- purchase_price -->
					<div class="row form-group">
                        <div class="col col-md-3">
                            <label for="textarea-input" class=" form-control-label">Purchase Price<span class="asterisk"> *</span></label>
                        </div>
                        <div class="col-12 col-md-9">
							<input type="text" id="purchase_price" name="purchase_price" placeholder="Enter Purchase Price..." class="form-control" value="{{old('purchase_price')}}" required>
                        </div>
                    </div>                                        
					<!-- item image -->
					<div class="row form-group">
						<div class="col col-md-3">
							<label for="hf-email" class=" form-control-label">Product Image</label>
						</div>
						<div class="col-12 col-md-9">
						    <input type="file" id="image" name = "image" class="form-control-file" />
						</div>
					</div>
				</div>
				<div class="card-footer">
					<div class="col-md-2 offset-md-5 mr-auto ml-auto">
						<input type="hidden" name="action" value="store">
						<button type="submit" class="btn btn-success form-control"><span class="fa fa-plus">&nbsp;</span>Add</button>
					</div>
				</div>
				</form>
			</div>
			<!-- end add product -->
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<strong>Edit/Delete Products</strong> 
				</div>
	        	<div class="card-body card-block">
					<!-- table -->
					<table id="ICTable" class="table table-hover ">
						<thead>
							<tr>
								<th width="15%">Image</th>
								<th width="65%">Details</th>
								<th width="20%">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($items as $item)
							<tr>
								<td>
									<div style="width: 160px;height: 110px;">
										@if($item->item_image)
											<img class="card-img-top" src="{{asset('products/'.$item->item_image)}}" style="height: 100%; width: 100%;">
										@else
											<img class="card-img-top" src="{{asset('images/image.png')}}" style="height: 100%; width: 100%;">
										@endif									
									</div>
								</td>
								<td>
									Name: <b>{{$item->item_name}}</b><br>
									Description: {{$item->item_description}}<br>
									Category: {{$item->category->category_name}} @if($item->sub_category_id) - {{$item->sub_category->sub_category_name}} @endif <br>
									Quantity: <b>{{$item->item_quantity}}</b> {{$item->item_unit}} <br>
									Selling price: {{number_format($item->selling_price,2)}} <br>
									Purchase price: {{number_format($item->purchase_price,2)}} <br>
								</td>
								<td>
									<a href="{{ route('item.edit',$item->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
									<button type="button" class="btn btn-danger btn-sm" id = "ICDestroy" data-id="{{$item->id}}" data-item_name="{{$item->item_name}}" data-item_description="{{$item->item_description}}">
										<i class="fa fa-times"></i> 
									</button>

								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<!-- end table -->
				</div>
			</div>
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

	$(document).on('change','#category',function(){
        $.post("{{ route('item.dropdown') }}", { option: $(this).val() },
    	function(data) {
            $('#sub_category').empty();
            $('#sub_category').append($("<option></option>"));
            $.each(data.sub_categories, function(k, v) {
                $('#sub_category').append('<option value="'+data.sub_categories[k].id+'">'+data.sub_categories[k].sub_category_name+'</option>');
        	});
        });
    });
	// start CDestroy
	$('#ICDestroy[data-id]').on('click', function() {
		$('#DeleteModal').modal('show');
		$('#DeleteModalForm')[0].reset();
		$('label.DeleteConfirm').empty();
		$('label.DeleteConfirm').append('Are you sure you want to delete the <b>'+$(this).data('item_name')+'</b> Description: <b>'+$(this).data('item_description')+'</b> ?');
		$('h5#mediumModalLabel').empty();
		$('h5#mediumModalLabel').append('Delete <b>'+$(this).data('item_name')+'</b>?');
		$('input#id').val($(this).data('id'));
	});
	// end cdelete

	$('#ICTable').DataTable({     
		"aoColumnDefs": [
	        { "bSortable": false, "aTargets": [ 2 ] }, 
	    ]
	});
	
}); //end ready
</script>
@endsection


@section('modal')
<!-- delete  -->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form action="{{route('item.destroy')}}" method="post" class="form-horizontal" id="DeleteModalForm">
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
