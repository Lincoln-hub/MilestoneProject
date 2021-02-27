@extends('layouts.appmaster')

@section('title','login')

@section('content')
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<div class="container">
<form action="editJob" method="POST">
	<input type="hidden" name="_token" value=" <?php echo csrf_token()?>" />
	<h2>Edit Job Description</h2>
	<table>
		<tr>
			<td>Name</td>
			
			<td><input type="text" name="jobDes" maxlength="200" value="{{ $job->getJobDescription()}}"/></td>
			<td><input type="hidden" name="id" value="{{ $job->getId()}}" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" class="btn btn-dark btn-lg" value="Edit Job" /></td>
		</tr>
	</table>
</form>
<h5 align="center"><?php
//checks if message is instantiated, if so echos message
if (isset($msg)) {
    echo $msg;
}
?></h5>
@endsection
</div>