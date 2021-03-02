<!DOCTYPE html>
<html lang = "en">
<head>
<meta charset="UTF-8">
<meta name="viewport"
	  content ="width=device-width, user-scalable=no,maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content = "ie=edge">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<title>Grroup Members</title>
</head>
<body>
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
</body>
</html>
