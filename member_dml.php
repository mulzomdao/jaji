<?
    // session_start();
    // include "lib/session.php";
    include "lib/connect.php";
    include "lib/variable.php";
    include "lib/function.php";

    switch ($_REQUEST["dml_flag"]) {

        case "member_insert":
            $query = "
                insert into t_group (member_id, member_name, member_info, use_flag, reg_id, reg_time, modify_id, modify_time)
                select '$_POST[member_id]'
                    , '$_POST[member_name]'
                    , '$_POST[member_info]'
                    , 'Y'
                    , 'system'
                    , now()
                    , 'system'
                    , now()
                from dual
                on duplicate key
                update member_name = '$_POST[member_name]'
                    , member_info = '$_POST[member_info]'
                    , use_flag = 'Y'
                    , modify_id = 'system'
                    , modify_time = now()
            ";
            $result = mysqli_query($connect, $query);
            echo("<script>location.replace('member_list.php');</script>");
            break;

        case "member_update":
        $query = "
            update t_group set member_name = '$_POST[member_name]'
                , member_info = '$_POST[member_info]'
                , modify_id  = 'system'
                , modify_time = now()
            where member_id = '$_POST[member_id]'
        ";
        $result = mysqli_query($connect, $query);
        echo("<script>history.go(-1)</script>");
        break;

        case "member_delete":
        $query = "
            update t_group set use_flag = 'N'
                , modify_id  = 'system'
                , modify_time = now()
            where member_id = '$_GET[member_id]'
        ";
        $result = mysqli_query($connect, $query);
        echo("<script>location.replace('member_list.php');</script>");
        break;
    }
?>