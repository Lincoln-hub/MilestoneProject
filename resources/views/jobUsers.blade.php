@extends('layouts.appmaster')
@section('title', 'Job Page')

@section('content')
	<div class="containerfull">
	<div class="container-fluid">
    	<div class="row">
    		<div class="col-md-6">
    			<form action="searchJob" method="post">
    				@csrf
    				<div class="row form-group">
    					<div class="col-md-12">
    						<label for"">Search Job</label>
    						<input type="text" name ="jobName" class="form-control" maxlength="10" required>
    					</div>
    				</div>
    				
    				<div class="row form-group">
    					<div class="col-md-12">
    						<button type ="submit" class="btn btn-success w-50 float-right">Search</button>
    					</div>
    				</div>
    			</form>
    		</div>
    		<div class="col-md-6">
    		<div id="table-wrapper">
  <div id="table-scroll">
    			<table class="table table-striped table-hover">
    				<tr>
    					<th>Job Description</th>
    				</tr>
    				 @if(isset($jobs))
    				@foreach($jobs as $job)
        				<tr>
        					<td> <a href ="searchJob?jobid = {{ $job['ID'] }}">{{$job['DESCRIPTION']}}</a></td>
        					<td class="col-3">
            					<form action="jobDetails" method="post">
        							<input type="hidden" name="_token" value="{{ csrf_token()}}" /> 
        							
    							</form>
							</td>       					
        				</tr>       				
        			@endforeach
        			@endif
    			</table>
    				</div>
    	</div>
    		</div>
    	</div>
	</div>
	</div>
@endsection
