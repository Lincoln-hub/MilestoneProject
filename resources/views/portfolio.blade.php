
@extends('layouts.appmaster')

@section('title','Login')

@section('content')
<div class ="containerfull">
	<div class="container-fluid">
    	<div class="row">
    		<div class="col-md-6">
    			<form action="port" method="post">
    				@csrf
    				<div class="row form-group">
    					<div class="col-md-12">
    						<label for"">Education</label>
    						<input type="text" name ="education" class="form-control" required>
    					</div>
    				</div>
    				<div class="row form-group">
    					<div class="col-md-12">
    						<label for"">Work History</label>
    						<input type="text" name ="workhistory" class="form-control" required>
    					</div>
    				</div>
    				<div class="row form-group">
    					<div class="col-md-12">
    						<label for"">Skills</label>
    						<input type="text" name ="skills" class="form-control" required>
    					</div>
    				</div>
    				<div class="row form-group">
    					<div class="col-md-12">
    						<button type ="submit" class="btn btn-success w-50 float-right">Create</button>
    					</div>
    				</div>
    			</form>
    		</div>
    		<br>
    		<br>
    		<div class="col-md-6">
    			<table class="table table-striped table-hover">
    				<tr>
    					<th>Group Name</th>
    					<th>View Group</th>
    				</tr>
    				 @if(isset($groups))
    				@foreach($groups as $g)
        				<tr>
        					<td>{{$g['NAME']}}</td>
        					
        					<td class="col-3"><form action="viewGroup" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token()}}" /> <input
								type="hidden" name="groupID" value="{{ $g['ID'] }}" />
								 <input type="submit" class="btn btn-secondary btn-small" value="View Group" />
								</form></td>
        				</tr>       				
        			@endforeach
        			@endif
    			</table>
    		</div>
    		<form>
    		<div class="col-md-6">
    			<table class="table table-striped table-hover">
    				<tr>
    					<th>Education</th>
    					
    				</tr>
    				 @if(isset($portfolio))
    				@foreach($portfolio as $p)
        				<tr>
        					<td>{{$p['WORKHISTORY']}}</td>			
        				</tr>       				
        			@endforeach
        			@endif
    			</table>
    		</div>
    		
    		<div class="col-md-6">
    			<table class="table table-striped table-hover">
    				<tr>
    					<th>Work History</th>
    					
    				</tr>
    				 @if(isset($portfolio))
    				@foreach($portfolio as $p)
        				<tr>
        					<td>{{$p['EDUCATION']}}</td>
     				
        				</tr>       				
        			@endforeach
        			@endif
    			</table>
    		</div>
    		
    		<div class="col-md-6">
    			<table class="table table-striped table-hover float-right">
    				<tr>
    					<th>Skills</th>
    					
    				</tr>
    				 @if(isset($portfolio))
    				@foreach($portfolio as $p)
        				<tr>
        					<td>{{$p['SKILLS']}}</td>	
        				</tr>       				
        			@endforeach
        			@endif
    			</table>
    		</div>
    		</form>
    		<form action ="toJobs" method = "get">
    		<input type="submit" class="btn btn-secondary btn-small" value="View Job Postings" />
    		</form>
    	</div>
	</div>
	</div>
	@endsection
