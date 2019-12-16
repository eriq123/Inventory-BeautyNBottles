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
					<strong>Edit Product</strong> 
				</div>
				<div class="card-body card-block">

					<!-- name -->
					<div class="row form-group">
						<div class="col col-md-3">
							<label for="hf-email" class=" form-control-label">Product Name<span class="asterisk"> *</span></label>
						</div>
						<div class="col-12 col-md-9">
							<input type="text" id="item_name" name="item_name" placeholder="Enter Product Name..." class="form-control" value="{{$item->item_name}}" required>
						</div>
					</div>
					<!-- description -->
					<div class="row form-group">
                        <div class="col col-md-3">
                            <label for="textarea-input" class=" form-control-label">Product Description<span class="asterisk"> *</span></label>
                        </div>
                        <div class="col-12 col-md-9">
                            <textarea id="item_description" name="item_description" rows="4" placeholder="Enter Product Description..." class="form-control" required>{{$item->item_description}}</textarea>
                        </div>
                    </div>

					<!-- category -->
					<div class="row form-group">
						<div class="col col-md-3">
							<label for="hf-email" class=" form-control-label">Category<span class="asterisk"> *</span></label>
						</div>
						<div class="col-12 col-md-9">
							<select name="category" id="category" class="form-control" value = "{{$item->category->category_name}}" required>
								<option selected="selected"></option>
								@foreach($categories as $category)
									<option value="{{$category->id}}" {{ ( $category->id == $item->category_id) ? 'selected' : '' }}>{{$category->category_name}}</option>
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
							<select name="sub_category" id="sub_category" class="form-control" >
							<option selected="selected"></option>
							@foreach($sub_categories as $sub_category)
								<option value="{{$sub_category->id}}" {{ ( $sub_category->id == $item->sub_category_id) ? 'selected' : '' }}>{{$sub_category->sub_category_name}}</option>
							@endforeach
							</select>
						</div>
					</div>

					<!-- quantity -->
					<div class="row form-group">
                        <div class="col col-md-3">
                            <label for="textarea-input" class=" form-control-label">Quantity<span class="asterisk"> *</span></label>
                        </div>
                        <div class="col-12 col-md-9">
							<input type="text" id="quantity" name="quantity" placeholder="Enter Quantity..." class="form-control" value="{{$item->item_quantity}}" required>
                        </div>
                    </div>

                    <!-- unit -->
					<div class="row form-group">
                        <div class="col col-md-3">
                            <label for="textarea-input" class=" form-control-label">Unit<span class="asterisk"> *</span></label>
                        </div>
                        <div class="col-12 col-md-9">
							<input type="text" id="unit" name="unit" placeholder="Enter Unit..." class="form-control" value="{{$item->item_unit}}" required>
                        </div>
                    </div>

                    <!-- limit -->
					<div class="row form-group">
                        <div class="col col-md-3">
                            <label for="textarea-input" class=" form-control-label">Limit<span class="asterisk"> *</span></label>
                        </div>
                        <div class="col-12 col-md-9">
							<input type="text" id="limit" name="limit" placeholder="Enter Product Limit..." class="form-control" value="{{$item->item_limit}}" required>
                        </div>
                    </div>

                    <!-- selling_price -->
					<div class="row form-group">
                        <div class="col col-md-3">
                            <label for="textarea-input" class=" form-control-label" >Selling Price<span class="asterisk"> *</span></label>
                        </div>
                        <div class="col-12 col-md-9">
							<input type="text" id="selling_price" name="selling_price" placeholder="Enter Selling Price..." class="form-control" value="{{$item->selling_price}}" required>
                        </div>
                    </div>

                    <!-- purchase_price -->
					<div class="row form-group">
                        <div class="col col-md-3">
                            <label for="textarea-input" class=" form-control-label">Purchase Price<span class="asterisk"> *</span></label>
                        </div>
                        <div class="col-12 col-md-9">
							<input type="text" id="purchase_price" name="purchase_price" placeholder="Enter Purchase Price..." class="form-control" value="{{$item->purchase_price}}" required>
                        </div>
                    </div>                                        
					<!-- item image -->
					<div class="row form-group">
						<div class="col col-md-3">
							<label for="hf-email" class=" form-control-label">Product Image</label>
						</div>
						<div class="col-12 col-md-9">
						    <input type="file" id="image" name = "image" class="form-control-file" />
						    <div class="ImageContainer">
							@if($item->item_image)
						    	<img src="{{asset('products/'.$item->item_image)}}" alt="Product Image" style="width: 100%; height: 100%;">
					    	@else
						    	<img src="{{asset('images/image.png')}}" alt="Product Image" style="width: 100%; height: 100%;">
							@endif
						    </div>
						</div>	
					</div>
				</div>
				<div class="card-footer">
					<div class="col-md-4 offset-md-4 mr-auto ml-auto">
						<div class="row form-group">
							<div class="col-md-6">
								<input type="hidden" name="id" value="{{$item->id}}">
								<input type="hidden" name="action" value="Update">
								<button type="submit" class="btn btn-primary form-control"><span class="fa fa-edit">&nbsp;</span>Edit</button>
							</div>
					
							<div class="col-md-6">
								<a href="{{route('item.index')}}" class="btn btn-danger form-control"><span class="fa fa-times">&nbsp;</span>Cancel</a>
							</div>
						</div>
					</div>
				</div>
				</form>
			</div>
			<!-- end add product -->
        </div>
    </div>
</div>


@endrole
@endsection

@section('css')
<!-- <link rel="stylesheet" href="{{asset('datatable/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('datatable/dataTables.bootstrap4.min.css')}}"> -->
@endsection

@section('Js')
<!-- <script src="{{asset('datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('datatable/dataTables.bootstrap4.min.js')}}"></script> -->
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
		$('label.DeleteConfirm').append('Are you sure you want to delete the <b>'+$(this).data('sub_category_name')+'</b> from '+$(this).data('category_name')+' category?');
		$('h5#mediumModalLabel').empty();
		$('h5#mediumModalLabel').append('Delete <b>'+$(this).data('sub_category_name')+' '+$(this).data('category_name')+'</b> ?');
		$('input#id').val($(this).data('id'));
	});
	// end cdelete
}); //end ready
</script>
@endsection


@section('modal')
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
