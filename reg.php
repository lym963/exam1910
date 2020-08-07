<?php
    //接值
    $name=empty($_POST["name"]) ? "":$_POST["name"];
    $pwd=empty($_POST["pwd"]) ? "":$_POST["pwd"];
    $password=empty($_POST["password"]) ? "":$_POST["password"];
    $tel=empty($_POST["tel"]) ? "":$_POST["tel"];
    //判断密码和确认密码是否一致
    if($pwd != $password){
        echo "确认密码和密码不一致，请重新输入";
        die;
    }
    $arr=[
        "host"=>"127.0.0.1",    //IP
        "dbname"=>"exam1910",       //数据库名
        "pass"=>"root",         //密码
        "port"=>"3306",         //端口
        "user"=>"root"          //连接名
    ];
    //连库
    $link=mysqli_connect($arr["host"],$arr["user"],$arr["pass"],$arr["dbname"],$arr["port"]);
    //sql
    $sql="insert into user(name,pwd,tel) values('$name','$pwd','$tel')";
    //执行sql
    $res=mysqli_query($link,$sql);
    //判断是否注册成功
    if($res==1){
        echo "注册成功";
        header("refresh:1;url=index.html");
    }else{
        echo "注册失败";
        header("refresh:1;url=reg.html");
    }

