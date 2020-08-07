<?php
    //接值
    $name=empty($_POST["name"])? "":$_POST["name"];
    $pwd=empty($_POST["pwd"])? "":$_POST["pwd"];
    $arr=[
        "host"=>"127.0.0.1",    //IP
        "dbname"=>"exam1910",       //数据库名
        "pass"=>"root",         //密码
        "port"=>"3306",         //端口
        "user"=>"root"          //连接名
    ];
    //连库
    $dbh=new PDO("mysql:host={$arr['host']};dbname={$arr['dbname']}",$arr["user"],$arr["pass"]);
    //sql语句   值可以为 ?    :value
    $sql="select * from user where name=:name";
    //准备要执行的语句
    $sth=$dbh->prepare($sql);
    //对参数占位符绑值
    $sth->bindParam(":name",$name);
    //调用存储过程
    $sth->execute();
    //将结果转为数组
    $data=$sth->fetchAll(PDO::FETCH_ASSOC);
    //判断用户名是否存在
    if(!empty($data)){
        //判断密码是否正确
        if($data[0]["pwd"] == $pwd){
            $redis = new Redis();
            //连接
            $redis->connect('127.0.0.1', 6379);
            $redis->auth("redis"); //密码验证
            $redis->set($data[0]["id"],$name);
            echo "登陆成功";
            header("refresh:1;url=aa.html");
        }
    }else{
        echo "用户名或密码错误";
        header("refresh:1;url=index.html");
    }


