@extends('index')

@section('content')
<div class="container-fluid" style="background-color: #fff;">
    <div class="row">
        <div class="col-lg-12" >
			<br>
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

		<div class=" table-responsive">
        	<!-- <div class="card-body card-block"> -->
				<!-- table -->
				<table id="STable" class="table table-hover">
					<thead>
						<tr>
							<th width="">Product List</th>
						</tr>
					</thead>
					<tbody>
						@foreach($items as $item)
						<tr>
							<td>
								<div class="row">
									<div class="col col-sm-2 col-md-3 col-lg-2">
										<div class="" style="max-width: 150px; max-height: 100px;display: block;">
											@if($item->item_image)
											<img class="card-img-top" src="{{asset('products/'.$item->item_image)}}" style="height: 100%; width: 100%;">
											@else
											<img class="card-img-top" src="{{asset('images/image.png')}}" style="height: 100%; width: 100%;">
											@endif
										</div>
									</div>
									<div class="col col-sm-10 col-md-9 col-lg-10 ">
										Name: <b>{{ucfirst($item->item_name)}}</b><br>
										Description: {{$item->item_description}}<br>
										Category: {{$item->category->category_name}} @if($item->sub_category_id) - {{$item->sub_category->sub_category_name}} @endif <br>
										Quantity: <b>{{$item->item_quantity}}</b> {{$item->item_unit}} <br>
										Selling price: {{number_format($item->selling_price,2)}} <br>
										@role('Admin|Assistant')
											@if($item->sub_category_id)
											<button type="button" class="btn btn-success" id="SAdd" data-id="{{$item->id}}" data-item_name="{{ucfirst($item->item_name)}}" data-item_description="{{$item->item_description}}" data-category="{{$item->category->category_name}}" data-sub-category="{{$item->sub_category->sub_category_name}}" data-quantity="{{$item->item_quantity}}" data-unit="{{$item->item_unit}}" data-action="Add">
											@else
											<button type="button" class="btn btn-success" id="SAdd" data-id="{{$item->id}}" data-item_name="{{ucfirst($item->item_name)}}" data-item_description="{{$item->item_description}}" data-category="{{$item->category->category_name}}" data-sub-category="" data-quantity="{{$item->item_quantity}}" data-unit="{{$item->item_unit}}" data-action="Add">
											@endif
												<i class="fa fa-plus"></i>
											</button>
										@endrole
										@hasanyrole('Admin|Assistant|Employee')
											@if($item->sub_category_id)
											<button type="button" class="btn btn-danger" id="SAdd" data-id="{{$item->id}}" data-item_name="{{ucfirst($item->item_name)}}" data-item_description="{{$item->item_description}}" data-category="{{$item->category->category_name}}" data-sub-category="{{$item->sub_category->sub_category_name}}" data-quantity="{{$item->item_quantity}}" data-unit="{{$item->item_unit}}" data-action="Deduct">
											@else
											<button type="button" class="btn btn-danger" id="SAdd" data-id="{{$item->id}}" data-item_name="{{ucfirst($item->item_name)}}" data-item_description="{{$item->item_description}}" data-category="{{$item->category->category_name}}" data-sub-category="" data-quantity="{{$item->item_quantity}}" data-unit="{{$item->item_unit}}" data-action="Deduct">
											@endif
												<i class="fa fa-minus"></i>
											</button>

										@endhasanyrole
									</div>
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<br>
				<!-- end table -->
		</div>
		<!-- </div> -->
		</div>
	</div>
</div>

@endsection

@section('css')

<link rel="stylesheet" href="{{asset('datatable/dt-1.10.18-r-2.2.2-datatables.min.css')}}">
<!-- <link rel="stylesheet" href="{{asset('datatable/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('datatable/dataTables.bootstrap4.min.css')}}"> -->
@endsection

@section('Js')
<script src="{{asset('datatable/dt-1.10.18-r-2.2.2-datatables.min.js')}}"></script>
<!-- <script src="{{asset('datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('datatable/dataTables.bootstrap4.min.js')}}"></script> -->
<script>
$( document ).ready(function() {

$('.alert').delay(2000).fadeOut('slow');

// // start cedit
$('#SAdd[data-id]').on('click', function() {
	$('#AddModal').modal('show');
	$('#AddModalForm')[0].reset();

	$('input#item_name').val($(this).data('item_name'));
	$('input#item_description').val($(this).data('item_description'));

	if ($(this).data('sub-category')) {
		$('input#category').val($(this).data('category') + ' - ' + $(this).data('sub-category'));
	}else{
		$('input#category').val($(this).data('category'));
	}

	$('input#quantity').val($(this).data('quantity'));

	$('input#id').val($(this).data('id'));
	$('input#action').val($(this).data('action'));

	if ($(this).data('action') == 'Add') {
		$('#mediumModalLabel').empty();
		$('#mediumModalLabel').append('Add Stocks');
		$('#QuantityLabel').empty();
		$('#QuantityLabel').append('Quantity to Add <span style="color:red;">*</span>');
		$('#buttonmodal').removeClass().addClass("btn btn-success");
		$('#actionfa').removeClass().addClass("fa fa-plus");
		$('#actiontext').empty();
		$('#actiontext').append('Add');
		$('#SalesLossDiv').hide();
		// hide discount if add
		$('#discountDiv').addClass('d-none');

	}else{
		$('#mediumModalLabel').empty();
		$('#mediumModalLabel').append('Deduct Stocks');
		$('#QuantityLabel').empty();
		$('#QuantityLabel').append('Quantity to Deduct <span style="color:red;">*</span>');
		$('#buttonmodal').removeClass().addClass("btn btn-danger");
		$('#actionfa').removeClass().addClass("fa fa-minus");
		$('#actiontext').empty();
		$('#actiontext').append('Deduct');
		$('#SalesLossDiv').show();
		$('#discountDiv').removeClass('d-none');
	}


}); 
// end cedit click

$('#loss').on('click', function() {
	$("#sales:checked").prop("checked", false); 
	$("#loss").prop("checked", true); 
	// $('#discountDiv').addClass('d-none');

});

$('#sales').on('click', function() {
	$("#loss:checked").prop("checked", false); 
	$("#sales").prop("checked", true); 
	// $('#discountDiv').removeClass('d-none');
	
});

$('#STable').DataTable({     
	responsive: true,
});

}); //end ready


</script>
@endsection


@section('modal')
<!-- edit  -->
<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form action="{{route('stock.store')}}" method="post" class="form-horizontal" id="AddModalForm">
			@csrf
				<div class="modal-header">
					<h5 class="modal-title" id="mediumModalLabel"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id = "id" name="id">
					<!-- product name -->
					<div class="row form-group">
						<div class="col col-md-3">
							<label for="hf-email" class=" form-control-label">Product Name</label>
						</div>
						<div class="col-12 col-md-9">
							<div class="input-group">
								<input type="text" id="item_name" name="item_name" class="form-control" readonly>
							</div>
						</div>
					</div>
					<!-- description -->
					<div class="row form-group">
						<div class="col col-md-3">
							<label for="hf-email" class=" form-control-label">Product Description</label>
						</div>
						<div class="col-12 col-md-9">
							<div class="input-group">
								<input type="text" id="item_description" name="item_description" class="form-control" readonly>
							</div>
						</div>
					</div>
					<!-- category -->
					<div class="row form-group">
						<div class="col col-md-3">
							<label for="hf-email" class=" form-control-label">Category</label>
						</div>
						<div class="col-12 col-md-9">
							<div class="input-group">
								<input type="text" id="category" name="category" class="form-control" readonly>
							</div>
						</div>
					</div>
					<!-- quantity -->
					<div class="row form-group">
						<div class="col col-md-3">
							<label for="hf-email" class=" form-control-label">Remaining Stock</label>
						</div>
						<div class="col-12 col-md-9">
							<div class="input-group">
								<input type="text" id="quantity" name="quantity" class="form-control" readonly>
							</div>
						</div>
					</div>
				
					<!-- sales or loss -->
					<div class="row form-group" id="SalesLossDiv">
						<div class="col col-md-3">
							<label for="hf-email" class=" form-control-label"></label>
						</div>
						<div class="col-12 col-md-9">
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="SalesLoss" id="sales" value="Sales" checked>
							  <label class="form-check-label" for="sales">Sales</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="SalesLoss" id="loss" value="Loss" >
							  <label class="form-check-label" for="loss">Loss</label>
							</div>
						</div>
					</div>

					<!-- QuantitytoAddorMinus -->
					<div class="row form-group">
						<div class="col col-md-3">
							<label for="hf-email" class=" form-control-label" id="QuantityLabel"></label>
						</div>
						<div class="col-12 col-md-9">
							<div class="input-group">
								<input type="number" id="QuantitytoAddorMinus" name="QuantitytoAddorMinus" class="form-control" min="0" max="999999" step="1" required>
							</div>
						</div>
					</div>
					<!-- discount -->
					<div class="row form-group" id="discountDiv">
						<div class="col col-md-3">
							<label for="hf-email" class=" form-control-label">Discount</label>
						</div>
						<div class="col-12 col-md-9">
							<div class="input-group">
								<input type="number" id="Discount" name="Discount" class="form-control" min="0" max="999999" step="1">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="action" id="action">
					<button type="submit" id="buttonmodal"><i id="actionfa"></i> <span id="actiontext"></span></button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- end edit  -->
@endsection