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
					<strong>Convert Stocks</strong> <br>
					<!-- <small>*Please select the product with low quantity</small> -->
				</div>
	        	<div class="card-body card-block">
	        		<form class="form-horizontal" method="POST" action="{{route('convert.action')}}">
	        		@csrf
						<div class="row form-group">
							<div class="col col-md-3">
								<button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#LowQty">Low Quantity Product </button>
							</div>
							<div class="col col-md-9">
								<input type="hidden" name="Lid" id="Lid">
								<div class="card-body mb-2" style="border: solid 1px;" id="LDiv">
									Name: <br>
									Description: <br>
									Category: <br>
 									Quantity: <br>
								</div>
							</div>
						</div>
						<div class="row form-group">
							<div class="col col-md-3" id="HQtyParentDiv">
								<button id="HQty" class="btn btn-sm btn-success disabled" type="button" >High Quantity Product </button>
							</div>
							<div class="col col-md-9">
								<input type="hidden" name="Hid" id="Hid">
								<div class="card-body mb-2" style="border: solid 1px;" id="HQtyDiv">
									Name: <br>
									Description: <br>
									Category: <br>
 									Quantity: <br>
								</div>
							</div>
						</div>
						<div class="row form-group">
							<div class="col col-md-3">
								<label for="hf-email" class=" form-control-label">Conversion</label>
							</div>
							<div class="col col-md-9">
								<input type="number" name="Conversion" id ="Conversion" class="form-control" placeholder="Please enter the equivalent of 1 high quantity product...">
							</div>
						</div>
						<div class="row form-group">
							<div class="col col-md-3">
								<label for="hf-email" class=" form-control-label">Quantity </label>
							</div>
							<div class="col col-md-9">
								<input type="number" name="Quantity" id ="Quantity" class="form-control" placeholder="Please enter how many high quantity product you want to convert...">
							</div>
						</div>
						<div class="row form-group">
							<div class="col col-md-4">
								<!-- just margin -->
							</div>
							<div class="col col-md-4">
								<button type="submit" class="btn btn-primary btn-block"><span class="fa fa-exchange-alt">&nbsp;</span>Convert</button>
							</div>
							<div class="col col-md-4">
								<!-- just margin -->
							</div>
						</div>
					</form>
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


// start LQty
$('#LSelect[data-id]').on('click', function() {
	var textarea = "Name: <b>" + $(this).data('item_name') + "</b><br>";
	textarea += "Description: <b>" + $(this).data('item_description') + "</b><br>";

	if ($(this).data('sub-category') == '') {
		textarea += "Category: <b>" + $(this).data('category') + "</b><br>";
	}else{
		textarea += "Category: <b>" + $(this).data('category') + " - "+$(this).data('sub-category')+"</b> <br>";
	}

	textarea += "Quantity: <b>" + $(this).data('quantity') + "</b> <b>"+$(this).data('unit')+"</b> <br>";
	
	$('#LDiv').html(textarea);
	$('#Lid').val($(this).data('id'));

	$('#HQtyParentDiv').empty().append("<button id='HQty' class='btn btn-sm btn-success' type='button' data-id = "+$(this).data('id')+">High Quantity Product </button>");

	var Htextarea = "Name: <br>";
	Htextarea += "Description: <br>";
	Htextarea += "Category: <br>";
	Htextarea += "Quantity: <br>";

	$('#HQtyDiv').html(Htextarea);
	$('#LowQty').modal('hide');

});
// end LQty

 var Ht = $('#Htable').DataTable({     
	"aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 1 ] }, 
    ]
});

// start HQty
$('div#HQtyParentDiv').on('click','#HQty', function() {

	$.ajax({
		type: "POST",
		url: "{{route('convert.high')}}",
		data: {
			id: $(this).data('id'),
		},
		success: function(data){
			if (data.Hitems.length == 0) {
				// alert(data.Hitems.length);
				console.log(data2);

				Ht.clear().draw();

				$('#HQtyTable').modal('show');

			}else{
				var data2 = JSON.parse(JSON.stringify(data.Hitems).replace(/\:null/gi, "\:\"\"")); 


				console.log(data2);

				Ht.clear().draw();

				$.each(data2, function( k, v ) {
					var data2info = "Name: <b>" + data2[k].item_name  + "</b><br>";
					data2info += "Description: " + data2[k].item_description + "<br>";

					if (data2[k].sub_category.sub_category_name == null) {
						data2info += "Category: " + data2[k].category.category_name + "<br>";
					}else{
						data2info += "Category: " + data2[k].category.category_name + " - "+ data2[k].sub_category.sub_category_name +"<br>";
					}

					data2info += "Quantity: <b>" + data2[k].item_quantity + "</b> "+ data2[k].item_unit +"<br>";	

					var data2btn = "<button  type='button' class='btn btn-success btn-sm' id='HSelect' ";
					data2btn += "data-item_name='"+data2[k].item_name+"'";
					data2btn += "data-id="+data2[k].id+" data-item_description='"+data2[k].item_description+"'";
					data2btn += "data-category='"+ data2[k].category.category_name+"' data-sub-category = '" + data2[k].sub_category.sub_category_name+"'";
					data2btn += "data-quantity=" +data2[k].item_quantity+" data-unit='" + data2[k].item_unit +"' >";
					data2btn += "Select</button>";


					Ht.row.add( [
				        data2info,
			            data2btn,
				    ] ).draw().nodes().to$();
		
				});	

			$('#HQtyTable').modal('show');
				
			}

			

		},
		errors: function(data){
			console.log(data);
		},

	});

});
// end HQty

// start HSelect
$('#Htable').on('click','#HSelect[data-id]', function() {
	var textarea = "Name: <b>" + $(this).data('item_name') + "</b><br>";
	textarea += "Description: <b>" + $(this).data('item_description') + "</b><br>";

	if ($(this).data('sub-category') == '') {
		textarea += "Category: <b>" + $(this).data('category') + "</b><br>";
	}else{
		textarea += "Category: <b>" + $(this).data('category') + " - "+$(this).data('sub-category')+"</b> <br>";
	}

	textarea += "Quantity: <b>" + $(this).data('quantity') + "</b> <b>"+$(this).data('unit')+"</b> <br>";
	
	$('#HQtyDiv').html(textarea);
	$('#Hid').val($(this).data('id'));

	$('#HQtyTable').modal('hide');

});
// end HSelect



$('#Ltable').DataTable({     
	"aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 1 ] }, 
    ]
});

}); //end ready


</script>
@endsection


@section('modal')
<!-- HQty  -->
<div class="modal fade" id="HQtyTable" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" >
		<div class="modal-content">
			<div class="card">
	        	<div class="card-body card-block">

				<!-- table -->
				<table id="Htable" class="table table-hover" >
					<thead>
						<tr>
							<th width="80%">Details</th>
							<th width="20%">Action</th>
						</tr>
					</thead>
					<tbody>
						<!-- <tr>
							<td></td>
							<td></td>
						</tr> -->
					</tbody>
				</table>
				<!-- end table -->
			
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end HQty  -->

<!-- LowQty  -->
<div class="modal fade" id="LowQty" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" >
		<div class="modal-content">
			<div class="card">
	        	<div class="card-body card-block">

				<!-- table -->
				<table id="Ltable" class="table table-hover" >
					<thead>
						<tr>
							<th width="80%">Details</th>
							<th width="20%">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($items as $item)
						<tr>
							<td>
								Name: <b>{{ucfirst($item->item_name)}}</b><br>
								Description: {{$item->item_description}}<br>
								Category: {{$item->category->category_name}} @if($item->sub_category_id) - {{$item->sub_category->sub_category_name}} @endif <br>
								Quantity: <b>{{$item->item_quantity}}</b> {{$item->item_unit}} <br>
							</td>
							<td>
							@role('Admin|Assistant')
								@if($item->sub_category_id)
								<button type="button" class="btn btn-danger btn-sm" id="LSelect" data-id="{{$item->id}}" data-item_name="{{$item->item_name}}" data-item_description="{{$item->item_description}}" data-category="{{$item->category->category_name}}" data-sub-category="{{$item->sub_category->sub_category_name}}" data-quantity="{{$item->item_quantity}}" data-unit="{{$item->item_unit}}">
									<!-- <i class="fa fa-check"></i> -->
									Select
								</button>
								@else
								<button type="button" class="btn btn-danger btn-sm" id="LSelect" data-id="{{$item->id}}" data-item_name="{{$item->item_name}}" data-item_description="{{$item->item_description}}" data-category="{{$item->category->category_name}}" data-sub-category="" data-quantity="{{$item->item_quantity}}" data-unit="{{$item->item_unit}}">
									<!-- <i class="fa fa-check"></i> -->
									Select
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
<!-- end LowQty  -->
@endsection
