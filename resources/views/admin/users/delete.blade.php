@extends('admin.layout.master')

@section('meta-title', trans('back.delete_user'))

@section('page-content')

    <div class="page-header">
        <h1>
            {{ trans('back.delete_user') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('back.delete_user_preferences') }}
            </small>

        </h1>
    </div><!-- /.page-header -->

    <!-- /section:settings.box -->
    <div class="page-content-area">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <h3 class="header smaller lighter red">
                    {{ $user->present()->fullName }}
                </h3>

                <!-- Form -->
                {{ Form::open(['route' => ['admin.users.delete', $user->id], 'class' => 'form-horizontal', 'method' => 'DELETE']) }}

                <div class="control-group">
                    <label class="control-label bolder blue">{{ trans('back.available_options') }}</label>

                    <div class="radio">
                        <label>
                            <input name="delete_option" type="radio" class="ace" value="delete_everything" checked>
                            <span class="lbl"> {{ trans('back.delete_all_user_listings', ['user' => $user->present()->fullName]) }} ({{ $user->present()->listingsNo }})</span>
                        </label>
                    </div>

                    <div class="radio">
                        <label>
                            <input name="delete_option" type="radio" class="ace" value="delete_transfer">
                            <span class="lbl"> {{ trans('back.transfer_listings_to') }}:</span>
                        </label>
                    </div>

                    <!-- select box for 'transfer_to'-->
                    <div class="form-group">
                        {{ Form::label('transfer_to', 'Transfer To:', ['class'=>'col-sm-3 control-label no-padding-right']) }}
                        <div class="col-sm-9">
                            <select name="transfer_to" class="form-control input-xlarge">
                                @foreach($recipients as $recipient)
                                    <option value="{{ $recipient->id }}">{{ $recipient->present()->fullName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>


                <!-- BUTTONS -->
                <div class="clearfix form-actions">
                    <div class="col-sm-offset-3 col-sm-9">
                        <!-- submit for button -->
                        <button class="btn btn-info" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            {{ trans('back.delete_user') }}
                        </button>

                        &nbsp; &nbsp; &nbsp;

                        <!-- cancel button -->
                        <a href="{{ URL::previous() }}">
                            <button class="btn btn-danger" type="button">
                                <i class="ace-icon fa fa-times bigger-110"></i>
                                {{ trans('back.cancel') }}
                            </button>
                        </a>

                    </div>
                </div>


                {{ Form::close() }}
                <!-- End of form -->

                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content-area -->

@stop