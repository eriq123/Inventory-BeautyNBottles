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
			<div class="card">
				<div class="card-header">
					<strong>Return to Sender</strong> 
				</div>
	        	<div class="card-body card-block">
					<!-- table -->
					<table id="Ltable" class="table table-hover">
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
									Name: <b>{{ucfirst($item->item_name)}}</b><br>
									Description: {{$item->item_description}}<br>
									Category: {{$item->category->category_name}} @if($item->sub_category_id) - {{$item->sub_category->sub_category_name}} @endif <br>
									Quantity: <b>{{$item->item_quantity}}</b> {{$item->item_unit}} <br>
									Selling price: {{number_format($item->selling_price,2)}} <br>
									Purchase price: {{number_format($item->purchase_price,2)}} <br>
								</td>
								<td>
								@role('Admin|Assistant')
									@if($item->sub_category_id)
									<button type="button" class="btn btn-info btn-sm" id="Srts" data-id="{{$item->id}}" data-item_name="{{$item->item_name}}" data-item_description="{{$item->item_description}}" data-category="{{$item->category->category_name}}" data-sub-category="{{$item->sub_category->sub_category_name}}" data-quantity="{{$item->item_quantity}}" data-unit="{{$item->item_unit}}" data-action="RTS"><i class="fa fa-undo"></i>
									</button>
									@else
									<button type="button" class="btn btn-info btn-sm" id="Srts" data-id="{{$item->id}}" data-item_name="{{$item->item_name}}" data-item_description="{{$item->item_description}}" data-category="{{$item->category->category_name}}" data-sub-category="" data-quantity="{{$item->item_quantity}}" data-unit="{{$item->item_unit}}" data-action="RTS"><i class="fa fa-undo"></i>
									</button>
									@endif
										
								@endrole
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
$('#Srts[data-id]').on('click', function() {
	$('#AddModal').modal('show');
	$('#AddModalForm')[0].reset();

	$('input#item_name').val($(this).data('item_name'));
	$('input#item_description').val($(this).data('item_description'));
	$('input#category').val($(this).data('category'));
	$('input#sub-category').val($(this).data('sub-category'));
	$('input#quantity').val($(this).data('quantity'));
	$('input#unit').val($(this).data('unit'));
	$('input#id').val($(this).data('id'));
	$('input#action').val($(this).data('action'));

	$('#mediumModalLabel').empty();
	$('#mediumModalLabel').append('Return to Sender');
	$('#QuantityLabel').empty();
	$('#QuantityLabel').append('Quantity to Return <span style="color:red;">*</span>');
	$('#buttonmodal').removeClass().addClass("btn btn-info");
	$('#actionfa').removeClass().addClass("fa fa-undo");
	$('#actiontext').empty();
	$('#actiontext').append('RTS');
	
}); 
// end cedit click

$('#Ltable').DataTable({     
	"aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 2 ] }, 
    ]
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
							<label for="hf-email" class=" form-control-label">Category Name</label>
						</div>
						<div class="col-12 col-md-9">
							<div class="input-group">
								<input type="text" id="category" name="category" class="form-control" readonly>
							</div>
						</div>
					</div>
					<!-- sub-category -->
					<div class="row form-group">
						<div class="col col-md-3">
							<label for="hf-email" class=" form-control-label">Sub-Category Name</label>
						</div>
						<div class="col-12 col-md-9">
							<div class="input-group">
								<input type="text" id="sub-category" name="sub-category" class="form-control" readonly>
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
					<!-- unit -->
					<div class="row form-group">
						<div class="col col-md-3">
							<label for="hf-email" class=" form-control-label">Unit</label>
						</div>
						<div class="col-12 col-md-9">
							<div class="input-group">
								<input type="text" id="unit" name="unit" class="form-control" readonly>
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
