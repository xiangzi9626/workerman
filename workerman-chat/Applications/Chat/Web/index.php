<?php
include $_SERVER["DOCUMENT_ROOT"]."/db/PDO.class.php";
$dbh=DBPDO::getDB();
$res=$dbh->query("select * from welive_advertisement");
$row=$res->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>workerman-chat PHP聊天室 Websocket(HTLM5/Flash)+PHP多进程socket实时推送技术</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/jquery-sinaEmotion-2.1.0.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  <script type="text/javascript" charset="UTF-8" src="/weilive1/welive.js"></script>
  <script type="text/javascript" src="js/swfobject.js"></script>
  <script type="text/javascript" src="js/web_socket.js"></script>
  <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-sinaEmotion-2.1.0.min.js"></script>
<script>
    $(function () {
        if (/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent)){
            $("#left").css("display","none");
             $("#right").css("display","none");
        }
            })
</script>
  <script type="text/javascript">
    if (typeof console == "undefined") {    this.console = { log: function (msg) {  } };}
    // 如果浏览器不支持websocket，会使用这个flash自动模拟websocket协议，此过程对开发者透明
    WEB_SOCKET_SWF_LOCATION = "/swf/WebSocketMain.swf";
    // 开启flash的websocket debug
    WEB_SOCKET_DEBUG = true;
    var ws, name, client_list={};

    // 连接服务端
    function connect() {
       // 创建websocket
       ws = new WebSocket("ws://"+document.domain+":7272");
       // 当socket连接打开时，输入用户名
       ws.onopen = onopen;
       // 当有消息时根据消息类型显示不同信息
       ws.onmessage = onmessage; 
       ws.onclose = function() {
    	  console.log("连接关闭，定时重连");
          connect();
       };
       ws.onerror = function() {
     	  console.log("出现错误");
       };
    }

    // 连接建立时发送登录信息
    function onopen()
    {
        if(!name)
        {
            show_prompt();
        }
        // 登录
        var login_data = '{"type":"login","client_name":"'+name.replace(/"/g, '\\"')+'","room_id":"<?php echo isset($_GET['room_id']) ? $_GET['room_id'] : 1?>"}';
        console.log("websocket握手成功，发送登录数据:"+login_data);
        ws.send(login_data);
    }

    // 服务端发来消息时
    function onmessage(e)
    {
        console.log(e.data);
        var data = JSON.parse(e.data);
        switch(data['type']){
            // 服务端ping客户端
            case 'ping':
                ws.send('{"type":"pong"}');
                break;;
            // 登录 更新用户列表
            case 'login':
                //{"type":"login","client_id":xxx,"client_name":"xxx","client_list":"[...]","time":"xxx"}
                say(data['client_id'], data['client_name'],  data['client_name']+' 加入了聊天室', data['time']);
                if(data['client_list'])
                {
                    client_list = data['client_list'];
                }
                else
                {
                    client_list[data['client_id']] = data['client_name']; 
                }
                flush_client_list();
                console.log(data['client_name']+"登录成功");
                break;
            // 发言
            case 'say':
                //{"type":"say","from_client_id":xxx,"to_client_id":"all/client_id","content":"xxx","time":"xxx"}
                say(data['from_client_id'], data['from_client_name'], data['content'], data['time']);
                break;
            // 用户退出 更新用户列表
            case 'logout':
                //{"type":"logout","client_id":xxx,"time":"xxx"}
                say(data['from_client_id'], data['from_client_name'], data['from_client_name']+' 退出了', data['time']);
                delete client_list[data['from_client_id']];
                flush_client_list();
        }
    }

    // 输入姓名
    function show_prompt(){  
        name = prompt('输入你的名字：', '');
        if(!name || name=='null'){  
            name = '游客';
        }
    }  

    // 提交对话
    function onSubmit() {
      var input = document.getElementById("textarea");
      var to_client_id = $("#client_list option:selected").attr("value");
      var to_client_name = $("#client_list option:selected").text();
      ws.send('{"type":"say","to_client_id":"'+to_client_id+'","to_client_name":"'+to_client_name+'","content":"'+input.value.replace(/"/g, '\\"').replace(/\n/g,'\\n').replace(/\r/g, '\\r')+'"}');
      input.value = "";
      input.focus();
    }

    // 刷新用户列表框
    function flush_client_list(){
    	var userlist_window = $("#userlist");
    	var client_list_slelect = $("#client_list");
    	userlist_window.empty();
    	client_list_slelect.empty();
    	userlist_window.append('<h4>在线用户</h4><ul>');
    	client_list_slelect.append('<option value="all" id="cli_all">所有人</option>');
    	for(var p in client_list){
            userlist_window.append('<li id="'+p+'">'+client_list[p]+'</li>');
            client_list_slelect.append('<option value="'+p+'">'+client_list[p]+'</option>');
        }
    	$("#client_list").val(select_client_id);
    	userlist_window.append('</ul>');
    }

    // 发言
    function say(from_client_id, from_client_name, content, time){
        //解析新浪微博图片
        content = content.replace(/(http|https):\/\/[\w]+.sinaimg.cn[\S]+(jpg|png|gif)/gi, function(img){
            return "<a target='_blank' href='"+img+"'>"+"<img src='"+img+"'>"+"</a>";}
        );

        //解析url
        content = content.replace(/(http|https):\/\/[\S]+/gi, function(url){
            if(url.indexOf(".sinaimg.cn/") < 0)
                return "<a target='_blank' href='"+url+"'>"+url+"</a>";
            else
                return url;
        }
        );

    	$("#dialog").append('<div class="speech_item"><img src="http://lorempixel.com/38/38/?'+from_client_id+'" class="user_icon" /> '+from_client_name+' <br> '+time+'<div style="clear:both;"></div><p class="triangle-isosceles top">'+content+'</p> </div>').parseEmotion();
    }

    $(function(){
    	select_client_id = 'all';
	    $("#client_list").change(function(){
	         select_client_id = $("#client_list option:selected").attr("value");
	    });
        $('.face').click(function(event){
            $(this).sinaEmotion();
            event.stopPropagation();
        });
    });


  </script>
    <style>
        #left *,#right *{
            max-width:100%;
            max-height:200px;
        }
    </style>
</head>
<body onload="connect();">

    <div class="container">
	
	    <div class="row clearfix">
		
	        <div class="col-md-2 column">
                <div id="left" style="width:100%;height:200px;"><?php echo $row["left"];?></div>
	        </div>
	        <div class="col-md-6 column">
			
	           <div class="thumbnail">
	               <div class="caption" id="dialog"></div>
	           </div>
	           <form onsubmit="onSubmit(); return false;">
	                <select style="margin-bottom:8px" id="client_list">
                        <option value="all">所有人</option>
                    </select>
                    <textarea class="textarea thumbnail" id="textarea"></textarea>
                    <div class="say-btn">
                        <input type="button" class="btn btn-default face pull-left" value="表情" />
                        <input type="submit" class="btn btn-default" value="发表" />
                    </div>
               </form>
               <div>
               &nbsp;&nbsp;&nbsp;&nbsp;<b>房间列表:</b>（当前在&nbsp;房间<?php echo isset($_GET['room_id'])&&intval($_GET['room_id'])>0 ? intval($_GET['room_id']):1; ?>）<br>
               &nbsp;&nbsp;&nbsp;&nbsp;<a href="/?room_id=1">房间1</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/?room_id=2">房间2</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/?room_id=3">房间3</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/?room_id=4">房间4</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/?room_id=1">房间5</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/?room_id=1">房间6</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/?room_id=1">房间7</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/?room_id=1">房间8</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/?room_id=1">房间9</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/?room_id=1">房间10</a>&nbsp;&nbsp;&nbsp;&nbsp;
               <br><br>
               </div>
               
	        </div>
	        <div class="col-md-3 column">
                <div id="right" style="width:100%;height:200px;"><?php echo $row["right"];?></div>
	           <div class="thumbnail">
                   <div class="caption" id="userlist"></div>
               
		
	        <div class="col-md-1 column">
	           <di<a href="https://www.baidu.com/" target="_blank"><img style="width:97px;margin-left:6px;" src=""></a>
	        </div>
	    </div>
    </div>
    <script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F7b1919221e89d2aa5711e4deb935debd' type='text/javascript'%3E%3C/script%3E"));</script>

</body>
</html>
