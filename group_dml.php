<?
    // session_start();
    // include "lib/session.php";
    include "lib/connect.php";
    include "lib/variable.php";
    include "lib/function.php";

    switch ($_REQUEST["dml_flag"]) {

        case "group_insert":
            $query = "
                insert into t_group (group_id, group_name, group_info, use_flag, reg_id, reg_time, modify_id, modify_time)
                select '$_POST[group_id]'
                    , '$_POST[group_name]'
                    , '$_POST[group_info]'
                    , 'Y'
                    , 'system'
                    , now()
                    , 'system'
                    , now()
                from dual
                on duplicate key
                update group_name = '$_POST[group_name]'
                    , group_info = '$_POST[group_info]'
                    , use_flag = 'Y'
                    , modify_id = 'system'
                    , modify_time = now()
            ";
            $result = mysqli_query($connect, $query);
            echo("<script>location.replace('group_list.php');</script>");
            break;

        case "group_update":
        $query = "
            update t_group set group_name = '$_POST[group_name]'
                , group_info = '$_POST[group_info]'
                , modify_id  = 'system'
                , modify_time = now()
            where group_id = '$_POST[group_id]'
        ";
        $result = mysqli_query($connect, $query);
        echo("<script>history.go(-1)</script>");
        break;

        case "group_delete":
        $query = "
            update t_group set use_flag = 'N'
                , modify_id  = 'system'
                , modify_time = now()
            where group_id = '$_GET[group_id]'
        ";
        $result = mysqli_query($connect, $query);
        echo("<script>location.replace('group_list.php');</script>");
        break;
    }
?>