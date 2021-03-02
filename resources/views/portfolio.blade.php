<!DOCTYPE html>
<html lang = "en">
<head>
<meta charset="UTF-8">
<meta name="viewport"
	  content ="width=device-width, user-scalable=no,maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content = "ie=edge">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<title>Profile</title>
</head>
<body>
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
</body>
</html>
