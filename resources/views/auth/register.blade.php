@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">

                    <?= Form::open(array('url' => 'user/register', 'class' => 'form-horizontal', 'role' => 'form')) ?>
                    <?= csrf_field() ?>

                    <div class="form-group<?= $errors->has('name') ? ' has-error' : '' ?>">
                        <?= Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) ?>
                        <div class="col-md-6">
                            <?= Form::input('name', 'name', old('name'), ['class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus']) ?>
                            <?php if ($errors->has('name')): ?>
                                <span class="help-block">
                                    <strong><?= $errors->first('name') ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group<?= $errors->has('email') ? ' has-error' : '' ?>">
                        <?= Form::label('email', 'E-Mail Address', ['class' => 'col-md-4 control-label']) ?>
                        <div class="col-md-6">
                            <?= Form::input('email', 'email', old('email'), ['class' => 'form-control', 'required' => 'required']) ?>
                            <?php if ($errors->has('email')): ?>
                                <span class="help-block">
                                    <strong><?= $errors->first('email') ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group<?= $errors->has('password') ? ' has-error' : '' ?>">
                        <?= Form::label('password', 'Password', ['class' => 'col-md-4 control-label']) ?>
                        <div class="col-md-6">
                            <?= Form::input('password', 'password', Null, ['class' => 'form-control', 'required' => 'required']) ?>
                            <?php if ($errors->has('password')) : ?>
                                <span class="help-block">
                                    <strong><?= $errors->first('password') ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?= Form::label('password-confirm', 'Confirm Password', ['class' => 'col-md-4 control-label']) ?>
                        <div class="col-md-6">
                            <?= Form::input('password', 'password_confirmation', Null, ['id' => 'password-confirm', 'class' => 'form-control', 'required' => 'required']) ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <?= Form::input('submit', 'Register', 'Register', ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                    <?= Form::close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
