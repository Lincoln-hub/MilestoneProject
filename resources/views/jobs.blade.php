@if (Session::has('userid'))
@extends('layouts.appmaster')

@section('title', 'Job Page')

@section('content')
<div class="containerfull">
	<div class="container-fluid">
    	
    		<div class="col-md-6">
    			<table class="table table-striped table-hover">
    				<tr>
    					<th>Job Description</th>
    					
    				</tr>
    				 @if(isset($jobs))
    				@foreach($jobs as $job)
        				<tr>
        					<td>{{$job['DESCRIPTION']}}</td>
        					
        					<td class="col-3"><form action="edit" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token()}}" /> <input
								type="hidden" name="jobID" value="{{ $job['ID'] }}" />
								</form></td>
								
							
        				</tr>       				
        			@endforeach
        			@endif
    			</table>
    		</div>
    	</div>
	</div>
	</div>
@endsection
@else
    <script>window.location.href = 'login';</script>

@endif