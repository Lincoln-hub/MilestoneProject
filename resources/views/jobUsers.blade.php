@extends('layouts.appmaster')
@section('title', 'Job Page')

@section('content')
	<div class="containerfull">
	<div class="container-fluid">
    	<div class="row">
    		<div class="col-md-6">
    			<form action="" method="post">
    				@csrf
    				
    			</form>
    		</div>
    		<div class="col-md-6">
    			<table class="table table-striped table-hover">
    				<tr>
    					<th>Job Description</th>
    				</tr>
    				 @if(isset($jobs))
    				@foreach($jobs as $job)
        				<tr>
        					<td>{{$job['DESCRIPTION']}}</td>
        					
        				</tr>       				
        			@endforeach
        			@endif
    			</table>
    		</div>
    	</div>
	</div>
	</div>
@endsection
