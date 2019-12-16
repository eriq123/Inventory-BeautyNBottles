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
					Weekly Report from <strong>{{$weekbefore->format('m/d')}} - {{$now->format('m/d')}}</strong>
					<!-- <a href="{{route('report.create')}}"  class="btn btn-success btn-sm mr-2 disabled" style="float: right;"><span class="fas fa-plus">&nbsp;</span>Create new Report</a> -->
					<a href="{{route('report.download')}}"  class="btn btn-primary btn-sm mr-2" style="float: right;"><span class="fa fa-download">&nbsp;</span>Download as PDF</a>
				</div>
	        	<div class="card-body card-block">
					<!-- table -->
					<table id="RTable" class="table table-hover " style="width:100%;">
						<thead>
							<tr>
								<th>Product Name</th>
								<th>Sales</th>
								<th>Losses</th>
								<th>RTS</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							@for ($i = 0; $i < $TotalReports; $i++)
							@if($sale[$i] == 0 and $loss[$i] == 0 and $rts[$i] == 0)
							@else
							<tr>
								<td>
									{{ ucfirst($name[$i]) }}
								</td>
								<td>
									{{ number_format($sale[$i],2) }}
								</td>
								<td>
									{{ number_format($loss[$i],2) }}
								</td>
								<td>
									{{ number_format($rts[$i],2) }}
								</td>
								<td>
									{{ number_format($sale[$i] - ($loss[$i] + $rts[$i]),2) }}
								</td>
							</tr>
							@endif
							@endfor

						</tbody>
					</table>
					<!-- end table -->
					<table class="table table-borderless">
						<tr>
							<td width="30%"></td>
							<td width="30%"></td>
							<td width="20%">Total Sales</td>
							<td width="20%">
								{{number_format($GrandTotalSales,2)}}
							</td>
						</tr>
						<tr>
							<td width="30%"></td>
							<td width="30%"></td>
							<td width="20%">Total Losses</td>
							<td width="20%">
								<span style="color:red;">{{number_format($GrandTotalLosses,2)}}</span>
							</td>
						</tr>
						<tr>
							<td width="30%"></td>
							<td width="30%"></td>
							<td width="20%">Total RTS</td>
							<td width="20%">
								<span style="color:red;">{{number_format($GrandTotalRTS,2)}}</span>
							</td>
						</tr>
						<tr>
							<td width="30%"></td>
							<td width="30%"></td>
							<td width="20%">Grand Total</td>
							<td width="20%">
								<b>{{number_format($GrandTotalSales - ($GrandTotalLosses + $GrandTotalRTS),2)}}</b>
							</td>
						</tr>
				</table>
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
$('#RTable').DataTable({     
	// "aoColumnDefs": [
 //        { "bSortable": false, "aTargets": [ 2 ] }, 
 //    ]
});
$('.alert').delay(5000).fadeOut('slow');


}); //end ready


</script>
@endsection


@section('modal')

@endsection
