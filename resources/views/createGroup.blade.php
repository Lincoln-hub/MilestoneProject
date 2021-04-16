@if (Session::has('adminID'))

@extends('layouts.adminappmaster')




@section('title','Login')

@section('content')
<div class ="containerfull">
	<div class="container-fluid">
    	<div class="row">
    		<div class="col-md-6">
    			<form action="createGroup" method="post">
    				@csrf
    				<div class="row form-group">
    					<div class="col-md-12">
    						<label for"">Enter Group Name</label>
    						<input type="text" name ="groupName" class="form-control" required>
    					</div>
    				</div>
    				<br>
    				<div class="row form-group">
    					<div class="col-md-12">
    						<button type ="submit" class="btn btn-success w-50 float-right">Create Group</button>
    					</div>
    				</div>
    			</form>
    		</div>
    		<div class="col-md-6">
    			<table class="table table-striped table-hover">
    				<tr>
    					<th>Group Name</th>
    					<th>Edit</th>
    					<th>Delete</th>
    				</tr>
    				 @if(isset($groups))
    				@foreach($groups as $g)
        				<tr>
        					<td>{{$g['NAME']}}</td>
        					
        					<td class="col-3"><form action="editGroup" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token()}}" /> <input
								type="hidden" name="groupID" value="{{ $g['ID'] }}" />
								 <input type="submit" class="btn btn-secondary btn-small" value="Edit" />
								</form></td>
								
								<td class="col-3"><form action="deleteGroup" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token()}}" /> <input
								type="hidden" name="groupID" value="{{ $g['ID'] }}" />
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
