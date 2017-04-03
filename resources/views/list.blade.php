@extends('layouts/app')

@section('content')

<div class="container">
    <div class="row" >
        <div class="col-md-2" style="background-color: rgb(217, 217, 217);border-radius: 5px;padding: 30px;">
            <ul class="nav nav-pills nav-stacked">
                <?= Form::open(array('method'=>'get', 'url' => 'user', 'class' => 'form-horizontal', 'role' => 'form')) ?>
                <?= csrf_field() ?>
                <li class="page-header"><h2>Search</h2></li>
                <div class="form-group<?= $errors->has('name') ? ' has-error' : '' ?>">
                    <li>
                        <?= Form::label('name', 'Name:') ?>
                        <?= Form::input('text', 'name', old('name'), ['class' => 'form-control']) ?>
                    </li>
                    <?php if ($errors->has('name')): ?>
                        <span class="help-block">
                            <strong><?= $errors->first('name') ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="form-group<?= $errors->has('email') ? ' has-error' : '' ?>">
                    <li>
                        <?= Form::label('email', 'Email:') ?>
                        <?= Form::input('email', 'email', old('email'), ['class' => 'form-control']) ?>
                    </li>
                    <?php if ($errors->has('email')): ?>
                        <span class="help-block">
                            <strong><?= $errors->first('email') ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <li>
                        <?= Form::label('role', 'Role:') ?>
                        <?= Form::select('role', App\Models\User::getRoleList(), old('role'), ['class' => 'form-control', 'style' => 'margin-bottom:80px']) ?>
                    </li>
                </div>
                <div class="form-group">
                    <li class="text-center">
                        <?= Form::input('submit', 'search', 'search', ['class' => 'btn btn-warning', 'style' => 'width: 100px']) ?>
                    </li>
                </div>
                <?= Form::close() ?>
            </ul>
        </div>
        <div class="col-md-10 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>All users</h2>
                </div>
                <div class="panel-body">
                    <table style="overflow: visible" border="1" class="table table-hover usersTable" >
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Edit</th>
                                <th>Products</th>
                            </tr>
                        </thead>
                        <tbody style="overflow: visible">



                            <?php foreach ($userArr as $userObj): ?>
                                <tr style="overflow: visible" data-user-id="<?= $userObj->id ?>">
                                    <td><?= $userObj->id ?></td>
                                    <td><?= $userObj->name ?></td>
                                    <td><?= $userObj->email ?></td>
                                    <td><?= $userObj->role ?></td>
                                    <td><a href="<?= URL::to('user', $userObj->id) ?>">Edit your page</a></td>
                                    <td style="overflow: visible" class="droppable" >
                                        <?php foreach ($userObj->product as $productObj): ?>
                                            <div class="draggable" data-product-id="<?= $productObj->id ?>" style="background-color:green; border:1px solid black;margin: 5px;width: 80px;height: 20px;">
                                                <?= $productObj->name ?>
                                            </div>
                                        <?php endforeach; ?>

                                    </td>
                                </tr>
                            <?php endforeach; ?>


                        </tbody>
                    </table>
                </div>
                <?= $userArr->appends(Request::only('name','email','role'))->render(); ?>
            </div>
        </div>

    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {

        /*$("li").click(function () {
         $page = $(this).find("a").attr("id");
         // $( "tr[data-user-id='Hot Fuzz']" )
         while (($("tr").attr('data-user-id').text()) < 20) {
         console.log($("tr"));
         }
         });*/

        drag();
        $(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
//            alert('test');
//            drag();
        })

        function drag()
        {
            // $(".rolelist[value='<?= $selectedrole ?>']").attr("selected", "selected");
            $(".draggable").draggable({
                containment: "tbody",
                axis: "y"
            });
            $("td.droppable").droppable({
                drop: function (event, ui) {
                    var user_id = $(this).parents('tr').attr('data-user-id');
                    var product_id = ui.draggable.attr('data-product-id');
                    var product_name = ui.draggable.text();
                    var targetElem = ui.draggable;
                    $.ajax({
                        type: 'POST',
                        url: "/change",
                        data: {user_id: user_id, product_id: product_id},
                        dataType: "json",
                        success: function (response) {

                        }
                    });
                    console.debug(ui.draggable);
                    ui.draggable.css({
                        top: '',
                        left: ''
                    });
                    $(this).append(ui.draggable);
                    // $(ui.draggable).css({'position': 'static'});

                }
            });

        }

    });
</script>

@endsection