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
			<div class="card">
				<div class="card-header">
					<strong>Logs</strong> 
				</div>
	        	<div class="card-body card-block">
					<!-- table -->
					<table id="STable" class="table table-hover" style="width:100%;">
						<thead>
							<tr>
								<th>Type</th>
								<!-- <th>Product Name</th>
								<th>Product Description</th>
								<th>Category</th>
								<th>Quantity</th>
								<th>Discount</th>
								<th>Total</th> -->
								<th>Details</th>
								<th>Date</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($logs as $log)
							<tr>
								<td>{{$log->status}} <br> by: {{$log->user->full_name}} </td>
								<td>Name: {{ucfirst($log->item->item_name)}}<br>
								Description: {{ strlen($log->item->item_description) > 30 ? substr($log->item->item_description,0,30).'..' : $log->item->item_description }}<br>
								Category: {{$log->item->category->category_name}} @if(!empty($log->item->sub_category->sub_category_name)) - {{$log->item->sub_category->sub_category_name}} @endif <br>
								Quantity: {{$log->quantity}}<br>
								Selling price: {{number_format($log->item->selling_price,2)}}<br>
								Discount: {{$log->discount}}<br>
								Total: {{number_format($log->total,2)}}</td>
								<td>{{$log->created_at}}</td>
								<td>
									@if(strpos($log->status,'Undo') == false)
										<form action="{{route('log.undo')}}" method="post" class="form-horizontal">
										@csrf
											<input type="hidden" name="id" value="{{$log->id}}">
											<input type="hidden" name="action" value="{{$log->status}}">
											<input type="hidden" name="quantity" value="{{$log->quantity}}">
											<input type="hidden" name="RemainingStock" value="{{$log->item->item_quantity}}">
											<button type="submit" class="btn btn-success btn-sm"><span class="fa fa-undo"></span></button>
										</form>
									@endif

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
$('#STable').DataTable({     
	"order": [[ 2, "desc" ]]
});
$('.alert').delay(5000).fadeOut('slow');



}); //end ready


</script>
@endsection


@section('modal')
@endsection
