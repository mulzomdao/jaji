<?
    // session_start();
    // include "lib/session.php";
    include "lib/connect.php";
    include "lib/variable.php";
    include "lib/function.php";

    if ($_GET[member_id] != "") $filter .= "and member_id like '%$_GET[member_id]%'";
    if ($_GET[member_name] != "") $filter .= "and member_name like '%$_GET[member_name]%'";
    if ($_GET[member_info] != "") $filter .= "and member_info like '%$_GET[member_info]%'";
    if ($_GET[reg_id] != "") $filter .= "and reg_id like '%$_GET[reg_id]%'";

    $query = "select count(*) total from t_group where use_flag = 'Y' $filter";
	$result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);
    $total = $row['total'];

    $query = "select * from t_group where use_flag = 'Y' $filter";
    // var_dump($query);
    $result = mysqli_query($connect, $query);
    if ($result === false) {
        var_dump($query);
    }
?>

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
    <div class="ibox">
        <div class="ibox-title">
            <h5>회원목록조회</h5>
        </div>
        <div class="ibox-content" style="padding: 15px">
            <div class="row" style="padding-left: 10px; padding-right: 10px">

                <form role="form" id="member_list" action="member_list.php" method="get">
                    <div class="col-sm-3" style="padding-left: 5px; padding-right: 5px">
                        <div class="form-group">
                            <div class="input-group"><input type="text" class="form-control input-sm" name="member_id" id="member_id" value="<?echo $_GET[member_id]?>" placeholder="회원ID">
                                <span class="input-group-btn" style="vertical-align: top">
                                    <button type="submit" class="btn btn-sm btn-white btn-submit"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3" style="padding-left: 5px; padding-right: 5px">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" name="member_name" id="member_name" value="<?echo $_GET[member_name]?>" placeholder="회원명">
                                <span class="input-group-btn" style="vertical-align: top">
                                    <button type="submit" class="btn btn-sm btn-white btn-submit"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3" style="padding-left: 5px; padding-right: 5px">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" name="member_info" id="member_info" value="<?echo $_GET[member_info]?>" placeholder="회원정보">
                                <span class="input-group-btn" style="vertical-align: top">
                                    <button type="submit" class="btn btn-sm btn-white btn-submit"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3" style="padding-left: 5px; padding-right: 5px">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" name="reg_id" id="reg_id" value="<?echo $_GET[reg_id]?>" placeholder="등록자">
                                <span class="input-group-btn" style="vertical-align: top">
                                    <button type="submit" class="btn btn-sm btn-white btn-submit"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

            <table class="footable table table-stripped" data-page-size="20" style="margin-bottom: 0px">
                <thead>
                    <tr>
                        <th width="48" class="text-center">No</th>
                        <th width="10%" data-hide="phone" class="text-center">회원ID</th>
                        <th width="10%" data-hide="phone" class="text-center">회원명</th>
                        <th width="*" data-hide="phone" class="text-center">회원정보</th>
                        <th width="10%" data-hide="phone" class="text-center">등록자</th>
                        <th width="15%" data-hide="phone" class="text-center">등록일</th>
                        <th width="10%" class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?if ($total == 0) {?>
                    <tr class="text-center">
                        <td colspan="100">데이터가 없습니다.</td>
                    </tr>
                    <?}?>
                    <?while ($rows = mysqli_fetch_array($result)) {?>
                    <tr class="text-center">
                        <td><?echo $total?></td>
                        <td><a href="member_edit.php?member_id=<?echo $rows[member_id]?>"><?echo $rows[member_id]?></a></td>
                        <td><?echo $rows[member_name]?></td>
                        <td><?echo $rows[member_info]?></td>
                        <td><?echo $rows[reg_id]?></td>
                        <td><?echo $rows[reg_time]?></td>
                        <td class="text-right">
                            <div class="btn-group">
                                <a type="button" class="btn btn-xs btn-white" href="member_edit.php">View</a>
                                <a type="button" class="btn btn-xs btn-white" href="javascript:member_delete('<?echo $rows[member_id]?>')">Delete</a>
                            </div>
                        </td>
                    </tr>
                    <?$total--;?>
                    <?}?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" style="padding-right: 0px; padding-left: 0px; padding-bottom: 0px;">
                            <a type="button" class="btn btn-sm btn-success" href="member_add.php">Add</a>
                        </td>
                        <td colspan="5" style="padding-right: 0px; padding-left: 0px; padding-bottom: 0px;">
                            <ul class="pagination pull-right"></ul>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<?include "inc/middle.php"?>

<script>
    $(document).ready(function () {

        member_delete = function(member_id) {
            if (confirm("삭제하시겠습니까?")) {
                location.href = "member_dml.php?dml_flag=member_delete&member_id=" + member_id;
            }
        }
    });
</script>

<?include "inc/end.php"?>