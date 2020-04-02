<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Identity and Access Management</title>
    <?php
    require ROOT . '/wp-config.php';
    ?>

    <link href="/assests/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/assests/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/assests/css/styles.css" rel="stylesheet">
    <link href="/assests/img/tripico.png" rel="shortcut icon" type="image/png" >
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="row">
            <div class="site-logo">
                <a href="#" class="brand">Identity and Access Management</a>
            </div>
            <div class="nav-links">
                <ul>
                    <li><a href="#">About us</a></li>
                    <li><a href="#">Contacts+</a></li>
                </ul>
            </div >
        </div>
    </div>
    </div>
</nav>

<main>
    <div class="main-block">
        <!-- Add section -->
        <form>
            <div class="container action-bar">
                <div class="form-row align-items-center">
                    <div class="col-auto my-1">
                        <button type="button" class="btn btn-outline-info open-m" data-toggle="modal" data-target="#exampleModal">Add</button>
                    </div>
                    <div class="col-sm-3 my-1">
                        <select class="custom-select action_status" name="status">
                            <option value="0" selected="selected" disabled>Please select</option>
                            <option value="1">Set active</option>
                            <option value="2">Set not active</option>
                            <option value="3">Delete</option>
                        </select>
                    </div>
                    <div class="col-auto my-1">
                        <button type="button" class="btn btn-outline-success action_user">OK</button>
                    </div>
                </div>
            </div>
        </form>




        <div class="container bootstrap snippet">
            <div class="table-responsive">
                <table class="table colored-header datatable project-list">
                    <thead>
                    <tr>
                        <th class="first-column">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input group_checkbox" id="group_checkbox_all" name="group_checkbox_all">
                                <label class="custom-control-label" for="group_checkbox_all"></label>
                            </div>
                        </th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Role</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($users)) : ?>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input group_checkbox" id="<?=$user['id']?>" name="<?=$user['id']?>" value="<?=$user['id']?>">
                                        <label class="custom-control-label" for="<?=$user['id']?>"></label>
                                    </div>
                                </td>
                                <td class="user_name"><?=$user['name']?></td>
                                <td><span class="<?=$user['status']?>"><i class="fa fa-circle"></i></span></td>
                                <td><?=$user['role']?></td>
                                <td>
                                    <a href="main/get?id=<?=$user['id']?>" class="edit-icon-1 my-ico-1" style=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <span style="text-decoration: none; color: red;" class=""><i class="fa fa-trash-o del_me_icon my-ico-1" aria-hidden="true"></i></span>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>



        <form>
            <div class="container action-bar">
                <div class="form-row align-items-center">
                    <div class="col-auto my-1">
                        <button type="button" class="btn btn-outline-info open-m" data-toggle="modal" data-target="#exampleModal">Add</button>
                    </div>
                    <div class="col-sm-3 my-1">
                        <select class="custom-select action_status" name="status">
                            <option value="0" selected="selected" disabled>Please select</option>
                            <option value="1">Set active</option>
                            <option value="2">Set not active</option>
                            <option value="3">Delete</option>
                        </select>
                    </div>
                    <div class="col-auto my-1">
                        <button type="button" class="btn btn-outline-success action_user">OK</button>
                    </div>
                </div>
            </div>
        </form>
</main>

<?php
$user1['name'] = $user1['name'] ?? ' ';
$names = explode(' ', $user1['name'])
?>

<section>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="firstName" class="col-form-label">First Name:</label>
                            <input type="text" class="form-control" id="firstName" data-id="<?=$user1['id'] ?? ''?>" value="<?=$names[0]?>">
                        </div>

                        <div class="form-group">
                            <label for="lastName" class="col-form-label">Last Name:</label>
                            <input type="text" class="form-control" id="lastName" value="<?=$names[1]?>">
                        </div>                        

                        <div class="form-group">
                            <span>Status:</span>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" <?=($user1['status'] == 'active') ? 'checked' : ''?>>
                                <label class="custom-control-label" for="customSwitch1"><?=($user1['status'] == 'active') ? 'Active' : 'Not-active'?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role">Role:</label>
                            <select class="form-control role" id="role" name="role">
                                <option value="Admin" <?=($user1['role'] == 'Admin') ? 'selected' : ''?>>Admin</option>
                                <option value="User" <?=($user1['role'] == 'User') ? 'selected' : ''?>>User</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close-bt">Close</button>
                    <button type="button" class="btn btn-primary test1" id="user_send">Add</button>
                </div>
                div
            </div>
        </div>
    </div>


    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6><i class="fa fa-exclamation-circle"></i>&nbsp;&nbsp;</h6>
                    <div class="modal-title" id="exampleModalLabel">Are you sure that you want to delete <strong class="person-del"></strong>?</div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary yes-modal">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="alertModal">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6><i class="fa fa-exclamation-circle"></i>&nbsp;&nbsp;</h6>
                    <h6>Please select <span class="alerm-item"></span>!</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

</section>
<footer id="footer" class="midnight-blue">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="text-center">
                    <a href="#home" class="scrollup"><i class="fa fa-angle-up fa-3x"></i></a>
                </div>
                &copy; OnePage Theme. All Rights Reserved.
                <div class="credits">
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div>
            </div>

            <div class="top-bar">
                <div class="col-lg-12">
                    <div class="social">
                        <ul class="social-share">
                            <li><a href="/"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="/"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="/"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="/"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="/"><i class="fa fa-skype"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--/#footer-->
<script src="/assests/js/jquery.js"></script>
<script src="/assests/js/bootstrap.min.js"></script>
<script src="/assests/js/ajax.js"></script>

</body>

</html>




