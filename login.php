<?
    session_start();
    include "lib/variable.php";

	if ($_SESSION[admin_id]) {
        echo("<script>location.replace('main.php');</script>"); 
    }
?>
<!DOCTYPE html>
<html>
<!-- Mirrored from webapplayers.com/inspinia_admin-v2.7.1/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 01 Mar 2018 07:33:35 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CQA Admin | Login</title>
    <link rel="icon" type="image/png" sizes="96x96" href="/image/favicon.png">

    <link href="inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="inspinia/css/animate.css" rel="stylesheet">
    <link href="inspinia/css/style.css" rel="stylesheet">
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h2 class="logo-name" style="font-size: 150px; padding-right: 10px">8IIID.</h2>
            </div>
            <h3>Welcome to JAJI System</h3>
            <p>Login in. To see it in action.</p>
            <form class="m-t" role="form" id="login" action="member_check.php" method="post">
                <input type="hidden" name="db_access_flag" value="login">
                <div class="form-group">
                    <input type="text" name="member_id" class="form-control" placeholder="Username">
                </div>
                <div class="form-group">
                    <input type="password" name="member_password" class="form-control" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <!-- <a href="inspinia/#"><small>Forgot password?</small></a> -->
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="/member_join.php">Create an account</a>
            </form>
            <!-- <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p> -->
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="inspinia/js/jquery-3.1.1.min.js"></script>
    <script src="inspinia/js/bootstrap.min.js"></script>
    <script src="inspinia/js/plugins/validate/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function () {

            $("#login").validate({
                rules: {
                    member_id: {
                        required: true,
                        rangelength: [4, 20]
                    },
                    member_password: {
                        required: true,
                        rangelength: [4, 20]
                    }
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });

            if ('<?echo $_login_flag[$_GET[flag]]?>' != '') {
                alert('<?echo $_login_flag[$_GET[flag]]?>');
            }

        });
    </script>

</body>

<!-- Mirrored from webapplayers.com/inspinia_admin-v2.7.1/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 01 Mar 2018 07:33:35 GMT -->
</html>