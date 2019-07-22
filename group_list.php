<?
    // session_start();
    // include "lib/session.php";
    include "lib/connect.php";
    include "lib/variable.php";
    include "lib/function.php";

    if ($_GET[group_id] != "") $filter .= "and group_id like '%$_GET[group_id]%'";
    if ($_GET[group_name] != "") $filter .= "and group_name like '%$_GET[group_name]%'";
    if ($_GET[group_info] != "") $filter .= "and group_info like '%$_GET[group_info]%'";
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
        <h2>그룹관리</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>시스템관리</li>
            <li class="active">
                <strong>그룹관리</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <div class="ibox">
        <div class="ibox-title">
            <h5>그룹목록조회</h5>
        </div>
        <div class="ibox-content" style="padding: 15px">
            <div class="row" style="padding-left: 10px; padding-right: 10px">

                <form role="form" id="group_list" action="group_list.php" method="get">
                    <div class="col-sm-3" style="padding-left: 5px; padding-right: 5px">
                        <div class="form-group">
                            <div class="input-group"><input type="text" class="form-control input-sm" name="group_id" id="group_id" value="<?echo $_GET[group_id]?>" placeholder="그룹ID">
                                <span class="input-group-btn" style="vertical-align: top">
                                    <button type="submit" class="btn btn-sm btn-white btn-submit"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3" style="padding-left: 5px; padding-right: 5px">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" name="group_name" id="group_name" value="<?echo $_GET[group_name]?>" placeholder="그룹명">
                                <span class="input-group-btn" style="vertical-align: top">
                                    <button type="submit" class="btn btn-sm btn-white btn-submit"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3" style="padding-left: 5px; padding-right: 5px">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" name="group_info" id="group_info" value="<?echo $_GET[group_info]?>" placeholder="그룹정보">
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
                        <th width="10%" data-hide="phone" class="text-center">그룹ID</th>
                        <th width="10%" data-hide="phone" class="text-center">그룹명</th>
                        <th width="*" data-hide="phone" class="text-center">그룹정보</th>
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
                        <td><a href="group_edit.php?group_id=<?echo $rows[group_id]?>"><?echo $rows[group_id]?></a></td>
                        <td><?echo $rows[group_name]?></td>
                        <td><?echo $rows[group_info]?></td>
                        <td><?echo $rows[reg_id]?></td>
                        <td><?echo $rows[reg_time]?></td>
                        <td class="text-right">
                            <div class="btn-group">
                                <a type="button" class="btn btn-xs btn-white" href="group_edit.php">View</a>
                                <a type="button" class="btn btn-xs btn-white" href="javascript:group_delete('<?echo $rows[group_id]?>')">Delete</a>
                            </div>
                        </td>
                    </tr>
                    <?$total--;?>
                    <?}?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" style="padding-right: 0px; padding-left: 0px; padding-bottom: 0px;">
                            <a type="button" class="btn btn-sm btn-success" href="group_add.php">Add</a>
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

        group_delete = function(group_id) {
            if (confirm("삭제하시겠습니까?")) {
                location.href = "group_dml.php?dml_flag=group_delete&group_id=" + group_id;
            }
        }
    });
</script>

<?include "inc/end.php"?>