<div class="row">
    <div class="col-md-12">
        <div class="form-group @if ($errors->has('first_name')) has-error @endif">
            <label class="col-sm-4 control-label" for="inputName">First Name</label>
            <div class="col-sm-8">
                {!! Form::text('first_name', $user->first_name, ['placeholder' => 'First name', 'class' => 'form-control']) !!}
                @if ($errors->has('first_name')) <p class="help-block">{{ $errors->first('first_name') }}</p> @endif
            </div>
        </div>

        <div class="form-group @if ($errors->has('last_name')) has-error @endif">
            <label class="col-sm-4 control-label" for="inputName">Last Name</label>
            <div class="col-sm-8">
                {!! Form::text('last_name', $user->last_name, ['placeholder' => 'Last name', 'class' => 'form-control']) !!}
                @if ($errors->has('last_name')) <p class="help-block">{{ $errors->first('last_name') }}</p> @endif
            </div>
        </div>

        <div class="form-group @if ($errors->has('email')) has-error @endif">
            <label class="col-sm-4 control-label" for="inputName">Email</label>
            <div class="col-sm-8">
                {!! Form::text('email', $user->email, ['placeholder' => 'Last name', 'class' => 'form-control']) !!}
                @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
            </div>
        </div>

        @if ($user->id == Auth::user()->id || Auth::user()->isAdmin())
            <div class="form-group @if ($errors->has('password')) has-error @endif">
                <label class="col-sm-4 control-label" for="inputName">Password</label>
                <div class="col-sm-8">
                    {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
                    @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                </div>
            </div>

            <div class="form-group @if ($errors->has('password_confirmation')) has-error @endif">
                <label class="col-sm-4 control-label" for="inputName">Password Confirmation</label>
                <div class="col-sm-8">
                    {!! Form::password('password_confirmation', ['placeholder' => 'Password Confirmation', 'class' => 'form-control']) !!}
                    @if ($errors->has('password_confirmation')) <p class="help-block">{{ $errors->first('password_confirmation') }}</p> @endif
                </div>
            </div>
        @endif

        @if (Auth::user()->isAdmin())
            <div class="form-group @if ($errors->has('status')) has-error @endif">
                <label class="col-sm-4 control-label" for="inputName">Status</label>
                <div class="col-sm-8">

                    <div class="radio">
                        <label>
                            <input name="status" value="A" type="radio" class="iCheck" {!! ((!empty($user->status) && $user->status=='A') || empty($user->status)) ? 'checked="checked"' : '' !!}> Active
                        </label>
                        &nbsp;&nbsp;&nbsp;
                        <label>
                            <input name="status" value="I" type="radio" class="iCheck" {!! (!empty($user->status) && $user->status=='I') ? 'checked="checked"' : '' !!}> Inactive
                        </label>
                    </div>

                    <p class="help-block">{{ $errors->first('status') }}</p>
                </div>
            </div>
        @endif
    </div>
</div>