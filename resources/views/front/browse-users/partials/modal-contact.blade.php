<div class="modal fade" id="modal-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">


            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Contact {{ $seller->present()->fullName }}</h4>
            </div>

            <!-- Form -->
            {{ Form::open(['route' => ['contactuser.send', $seller->id], 'class' => 'form-horizontal', 'id' => 'form-val']) }}

            <div class="modal-body">

                <!-- text field for 'Name'-->
                <div class="form-group">
                    {{ Form::label('name', 'Name: *', ['class'=>'col-sm-3 control-label']) }}
                    <div class="col-xs-10 col-sm-5">
                        {{ Form::text('name', null, ['class' => 'form-control']) }}
                    </div>
                </div>

                <!-- text field for 'Email'-->
                <div class="form-group">
                    {{ Form::label('email', 'Email: *', ['class'=>'col-sm-3 control-label']) }}
                    <div class="col-xs-10 col-sm-5">
                        {{ Form::email('email', null, ['class' => 'form-control']) }}
                    </div>
                </div>

                <!-- text field for 'Subject'-->
                <div class="form-group">
                    {{ Form::label('subject', 'Subject: *', ['class'=>'col-sm-3 control-label']) }}
                    <div class="col-xs-10 col-sm-5">
                        {{ Form::text('subject', null, ['class' => 'form-control']) }}
                    </div>
                </div>

                <!-- text area for 'Message'-->
                <div class="form-group">
                    {{ Form::label('message', 'Message: *', ['class'=>'col-sm-3 control-label']) }}
                    <div class="col-xs-10 col-sm-5">
                        {{ Form::textarea('message', null, ['class' => 'form-control', 'rows' => 3]) }}
                    </div>
                </div>

                @if (appCon()->captcha_contact_forms)
                    CAPTCHA!!!!!
                @endif

            </div>


            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">
                    Contact {{ $seller->present()->fullName }}
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
            </div>

            {{ Form::close() }}
            <!-- End of form -->

        </div>
    </div>

</div>