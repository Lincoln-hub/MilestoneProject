@extends('layouts.appmaster')
@section('title', 'Job Page')

@section('content')
	<div class="containerfull">
	<div class="container-fluid">
    	<div class="row">
    		<div class="col-md-6">
    			<table class="table table-striped table-hover">
    				<tr>
    				<th>Job ID</th>
    					<th>Job Description</th>
    	
    				</tr>
    				 @if(isset($job))
    				 @foreach($job as $j)
        				<tr>
        				<td>{{$j['ID']}}</td>
        					<td>{{$j['DESCRIPTION']}}</td>
        					<td><button type ="submit" class="btn btn-success w-15">Apply</button></td>
        				</tr>       				
        			@endforeach
        			@endif
    			</table>
    		</div>
    	</div>
	</div>
	</div>
@endsection