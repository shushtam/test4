@extends('layouts/app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit your profile</div>
                <div class="panel-body">
                    <?= Form::open(array('url' => 'user/' . $user->id . '/edit', 'class' => 'form-horizontal', 'role' => 'form')) ?>
                    <?= csrf_field() ?>
                    <div class="form-group<?= $errors->has('name') ? ' has-error' : '' ?>">
                        <?= Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) ?>
                        <div class="col-md-6">
                            <?= Form::input('text', 'name', $user->name, ['class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus']) ?>
                            <?php if ($errors->has('name')): ?>
                                <span class="help-block">
                                    <strong><?= $errors->first('name') ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group<?= $errors->has('email') ? ' has-error' : '' ?>">

                        <?= Form::label('email', 'Email', ['class' => 'col-md-4 control-label']) ?>
                        <div class="col-md-6">
                            <?= Form::input('email', 'email', $user->email, ['class' => 'form-control', 'required' => 'required']) ?>
                            <?php if ($errors->has('email')) : ?>
                                <span class="help-block">
                                    <strong><?= $errors->first('email') ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-success">
                                Save
                            </button>
                        </div>
                    </div>
                    <?= Form::close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
