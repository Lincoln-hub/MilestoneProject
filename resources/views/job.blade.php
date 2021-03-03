@if (Session::has('adminID'))
@extends('layouts.adminappmaster')
@section('title', 'Job Page')

@section('content')
<div class="containerfull">
	<div class="container-fluid">
    	<div class="row">
    		<div class="col-md-6">
    			<form action="addJob" method="post">
    				@csrf
    				<div class="row form-group">
    					<div class="col-md-12">
    						<label for"">Job Description</label>
    						<input type="text" name ="jobDes" class="form-control" required>
    					</div>
    				</div>
    				
    				<div class="row form-group">
    					<div class="col-md-12">
    						<button type ="submit" class="btn btn-success w-50 float-right">Add Job</button>
    					</div>
    				</div>
    			</form>
    		</div>
    		<div class="col-md-6">
    			<table class="table table-striped table-hover">
    				<tr>
    					<th>Job Description</th>
    					<th>Edit</th>
    					<th>Delete</th>
    				</tr>
    				 @if(isset($jobs))
    				@foreach($jobs as $job)
        				<tr>
        					<td>{{$job['DESCRIPTION']}}</td>
        					
        					<td class="col-3"><form action="edit" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token()}}" /> <input
								type="hidden" name="jobID" value="{{ $job['ID'] }}" />
								 <input type="submit" class="btn btn-secondary btn-small" value="Edit" />
								</form></td>
								
								<td class="col-3"><form action="deleteJob" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token()}}" /> <input
								type="hidden" name="jobID" value="{{ $job['ID'] }}" />
								 <input type="submit" class="btn btn-secondary btn-small" value="Delete" />
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