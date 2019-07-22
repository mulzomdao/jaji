<?include 'inc/start.php'?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>회원관리</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>시스템관리</li>
            <li class="active">
                <strong>회원관리</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>회원정보</small></h5>
                </div>
                <div class="ibox-content" style="padding-bottom: 10px">
                    <fieldset class="form-horizontal">

                        <form role="form" id="member_add" action="member_dml.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="dml_flag" name="dml_flag" value="member_insert">

                            <div class="form-group" style="margin-bottom: 5px">
                                <label class="col-sm-1 control-label" style="padding-left: 0px; padding-right: 0px"><i class="fa fa-check"></i> 회원ID</label>
                                <div class="col-sm-5"><input type="text" class="form-control input-sm" name="member_id" id="member_id" value=""></div>
                                <label class="col-sm-1 control-label" style="padding-left: 0px; padding-right: 0px"><i class="fa fa-check"></i> 회원명</label>
                                <div class="col-sm-5"><input type="text" class="form-control input-sm" name="member_name" id="member_name" value=""></div>
                            </div>
                            <div class="form-group" style="margin-bottom: 5px">
                                <label class="col-sm-1 control-label" style="padding-left: 0px; padding-right: 0px">회원정보</label>
                                <div class="col-sm-11"><textarea class="form-control" rows="4" name="member_info" id="member_info"></textarea></div>
                            </div>

                            <div class="form-group pull-right" style="margin-bottom: 5px; padding-right: 15px">
                                <button type="submit" class="btn btn-sm btn-success">Add</button>
                                <a type="button" class="btn btn-sm btn-success" href="javascript:history.go(-1)">Cancel</a>
                            </div>
                        </form>

                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>

<?include "inc/middle.php"?>

<script>
    $(document).ready(function () {

        $("#member_add").validate({
            rules: {
                member_id: {
                    required: true,
                    rangelength: [4, 20]
                },
                member_name: {
                    required: true,
                    rangelength: [2, 20]
                }

            },
            submitHandler: function (form) {
                if (confirm("등록 하시겠습니까?")) {
                    form.submit();
                }
            }
        });

    });
</script>

<?include "inc/end.php"?>