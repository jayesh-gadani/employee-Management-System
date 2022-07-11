<select class="form-control" name="userId">
	<option>--- select user ---</option>
	@foreach($users as $user)
		<option value='{{$user->user->id}}'>{{$user->user->name}}</option>
	@endforeach
	
</select>