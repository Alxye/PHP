<title>PHP+ajax分页演示</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<script language="javascript" src="ajaxpage.js"></script>
<div id="result">
    <?php
    $terry=new mysqli("localhost","root","")or  die("数据库连接失败".$e->getMessage());
    $terry->select_db('ajax');
    $terry->set_charset('utf8') ;
    $result=$terry->query("select * from tb_user");
    $total=$result->num_rows;
    $page=isset($_GET['page'])?intval($_GET['page']):1;
    $page_size=9;
    $url='index.php';
    $pagenum=ceil($total/$page_size);
    $page=min($pagenum,$page);
    $prepage=$page-1;
    $nextpage=($page==$pagenum?0:$page+1);
    $pageset=($page-1)*$page_size;
    $pagenav='';
    $pagenav.="显示第 <font color='red'>".($total?($pageset+1):0)."-".min($pageset+$page_size,$total)."</font>项记录 共<font color='red'>".$total."</font></>条记录 现在是第 <b><font color='blue'>".$page."</font></b> 页<br>";
    if($page<=1)
        $pagenav.="<a style=cursor:not-allowed;>当前为首页</a> ";
    else
        $pagenav.="<a onclick=javascript:dopage('result','$url?page=1') style=cursor:pointer;>跳转至首页</a> ";
    if($prepage)
        $pagenav.="<a onclick=javascript:dopage('result','$url?page=$prepage') style=cursor:pointer;>上一页</a> ";
    else {}
    if($nextpage)
        $pagenav.="<a onclick=javascript:dopage('result','$url?page=$nextpage') style=cursor:pointer;>下一页</a> ";
    else  {}
    if($page<$pagenum) {
        $pagenav .= "<a onclick=javascript:dopage('result','$url?page=$pagenum') style=cursor:pointer;>跳转至尾页</a> ";
    }
    else {
        $pagenav .= "<a style=cursor:not-allowed;>当前为尾页</a> ";
    }
    $pagenav.="共".$pagenum."页";

    if($page>$pagenum){
        echo "error:没有此页".$page;
        exit();
    }
    ?>
    <table align="center" border="2" width="300">
        <tr bgcolor="#cccccc" align="center">
            <td>用户名</td>
            <td>用户密码</td>
        </tr>
        <?php
        $info=$terry->query("select * from tb_user order by id desc limit $pageset,$page_size");
        while($array=$info->fetch_array()){
            ?>
            <tr align="center">
                <td><?php echo $array['id'];?></td>
                <td><?php echo $array['title'];?></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
    echo "<p align=center>$pagenav</p>";
    echo "<div align='center'>
<form action='index.php' method='post'>
<input type='number' name='setpage'>
<input type='submit' value='跳转' onclick=javascript:dopage('result','$url?page={$_POST['setpage']}')>
        </form>
      </div>
    ";
    ?>
</div>