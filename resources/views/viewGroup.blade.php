@if (Session::has('userid'))
@extends('layouts.appmaster')
@section('title', 'Job Page')

@section('content')
	<div class="containerfull">
	<div class="container-fluid">
    	<div class="row">
    		<div class="col-md-6">
    			<table class="table table-striped table-hover">
    				<tr>
    					<th>Firstname</th>
    					<th>Lastname</th>
    				</tr>
    				 @if(isset($users))
    				@foreach($users as $u)
        				<tr>
        					<td>{{$u['FIRSTNAME']}}</td>
        					<td>{{$u['LASTNAME']}}</td>
	
        				</tr>       				
        			@endforeach
        			@endif
    			</table>
		  <?php
        if (isset($msg)) {
            echo $msg;
        }
        ?>
        @if(isset($gID ))
    			<td class="col-3">
    				<form action="addToGroup" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token()}}" /> 
							<input type="hidden" name="groupID" value="{{ $gID }}" />
						    <input type="submit" class="btn btn-secondary btn-small" value="Join Group" />
					</form>
				</td>
				<br>
				<td class="col-3">
    				<form action="removeFromGroup" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token()}}" /> 
							<input type="hidden" name="groupID" value="{{ $gID }}" />
						    <input type="submit" class="btn btn-secondary btn-small" value="Leave Group" />
					</form>
				</td>
		
				@endif
    		</div>
    		
    	</div>
	</div>
	</div>
@endsection
@else
    <script>window.location.href = 'login';</script>

@endif
