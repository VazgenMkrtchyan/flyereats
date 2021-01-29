<!-- text field for 'First_name'-->
<div class="form-group">
	{{ Form::label('first_name', trans('back.first_name').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
	<div class="col-xs-10 col-sm-5">
		{{ Form::text('first_name', null, ['class' => 'form-control']) }}
	</div>
</div>

<!-- text field for 'Last_name'-->
<div class="form-group">
	{{ Form::label('last_name', trans('back.last_name').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
	<div class="col-xs-10 col-sm-5">
		{{ Form::text('last_name', null, ['class' => 'form-control']) }}
	</div>
</div>

<!-- text field for 'Email'-->
<div class="form-group">
	{{ Form::label('email', trans('back.email').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
	<div class="col-xs-10 col-sm-5">
		{{ Form::text('email', null, ['class' => 'form-control']) }}
	</div>
</div>

<!-- text field for 'Username'-->
<div class="form-group">
	{{ Form::label('username', trans('back.username').': *', ['class'=>'col-sm-3 control-label no-padding-right']) }}
	<div class="col-xs-10 col-sm-5">
		{{ Form::text('username', null, ['class' => 'form-control']) }}
	</div>
</div>

<!-- text field for 'Password'-->
<div class="form-group">
	{{ Form::label('password', trans('back.password').':', ['class'=>'col-sm-3 control-label no-padding-right']) }}
	<div class="col-xs-10 col-sm-5">
		{{ Form::password('password', ['class' => 'form-control']) }}
	</div>
</div>

<!-- text field for 'Password_confirmation'-->
<div class="form-group">
	{{ Form::label('password_confirmation', trans('back.password_confirmation').':', ['class'=>'col-sm-3 control-label no-padding-right']) }}
	<div class="col-xs-10 col-sm-5">
		{{ Form::password('password_confirmation', ['class' => 'form-control']) }}
	</div>
</div>


<div class="clearfix form-actions">
	<div class="col-sm-offset-3 col-sm-9">
		<!-- submit for button -->
		<button class="btn btn-info" type="submit">
			<i class="ace-icon fa fa-check bigger-110"></i>
			{{ trans('back.submit') }}
		</button>

	</div>
</div>

@section('additional-scripts')
    @include('admin.profile.js.js-edit')
@stop