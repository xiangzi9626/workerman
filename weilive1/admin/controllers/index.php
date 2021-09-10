<?php if(!defined('ROOT')) die('Access denied.');

class c_index extends Admin{

    function index($path){
		
		//获取统计数据
		$basedata = APP::$DB->getOne("SELECT (select COUNT(cid)  FROM " . TABLE_PREFIX . "comment WHERE readed = 0) AS new_comments, 
		(select COUNT(cid) FROM " . TABLE_PREFIX . "comment) AS comments,
		(select COUNT(gid) FROM " . TABLE_PREFIX . "guest) AS guests, 
		(select COUNT(mid) FROM " . TABLE_PREFIX . "msg) AS msgs, 
		(select COUNT(rid)  FROM " . TABLE_PREFIX . "rating) AS ratings");

		$dir_size = $this->dirsize(ROOT . 'upload/img/'); //上传图片文件夹的大小
		$dir_size = number_format($dir_size / 1024000, 2);


		SubMenu('欢迎进入 '.APP_NAME.' 管理中心', array(
			array('查看留言', 'comments'),
			array('管理客人', 'guests'),
			array('管理记录', 'messages'),
			array('管理评价', 'rating'),
			array('清理图片', 'upload_img'),
			array('智能客服管理', 'robot')
		));

		$welcome = '<ul><li>欢迎 <font class=orange>'.$this->admin['fullname'].'</font> 进入后台管理面板! 为了确保系统安全, 请在关闭前点击 <a href="#" class="logout">退出</a> 安全离开!</li>
		<li></li>
		<li></li></ul>';

		ShowTips($welcome, '系统信息');

		BR(2);

		TableHeader('运行数据统计');

		TableRow(array('1)', '访客总人数：&nbsp;&nbsp;&nbsp;'. Iif($basedata['guests'] > 100000, '<font class=redb>'.$basedata['guests'].'</font><a class="alert-btn" href="' . BURL('guests') . '">前往清理</a>', '<font class=greyb>'.$basedata['guests'].'</font>'), '', '留言总条数：&nbsp;&nbsp;&nbsp;'. Iif($basedata['comments'] > 100000, '<font class=redb>'.$basedata['comments'].'</font><a class="alert-btn" href="' . BURL('comments') . '">前往清理</a>', '<font class=greyb>'.$basedata['comments'].'</font>'), ''));
		TableRow(array('2)', '对话记录数：&nbsp;&nbsp;&nbsp;'. Iif($basedata['msgs'] > 100000, '<font class=redb>'.$basedata['msgs'].'</font><a class="alert-btn" href="' . BURL('messages') . '">前往清理</a>', '<font class=greyb>'.$basedata['msgs'].'</font>'), '', '访客评价数：&nbsp;&nbsp;&nbsp;'. Iif($basedata['ratings'] > 100000, '<font class=redb>'.$basedata['ratings'].'</font><a class="alert-btn" href="' . BURL('rating') . '">前往清理</a>', '<font class=greyb>'.$basedata['ratings'].'</font>'), ''));
		TableRow(array('3)', '上传图片大小：&nbsp;&nbsp;&nbsp;'. Iif($dir_size > 1000, '<font class=redb>'.$dir_size.' M</font><a class="alert-btn" href="' . BURL('upload_img') . '">前往清理</a>', '<font class=greyb>'.$dir_size.' M</font>'), '', '未读留言数：&nbsp;&nbsp;&nbsp;<font class=greyb>'.$basedata['new_comments'].'</font>', ''));

		TableFooter();


		BR(2);

		TableHeader('客服操作技巧说明');

		TableRow('<font class=grey>1)</font>&nbsp;&nbsp;将代码插入需要调用客服小面板的网页&lt;html&gt;内.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp任意网站、任何编码格式的页面(跨站、跨域名)均可调用, 包括淘宝, ECShop等商城系统. ');

		TableRow('<font class=grey>2)</font>&nbsp;&nbsp;客服窗口中, 按 Ctrl + Alt, 在客服交流区与当前客人小窗口间切换.');
		TableRow('<font class=grey>3)</font>&nbsp;&nbsp;客服窗口中, 按 Ctrl + 下箭头 或 Esc键, 关闭当前客人小窗口. 如果小窗口都关闭了, 自动切换到客服交流区.');
		TableRow('<font class=grey>4)</font>&nbsp;&nbsp;客服窗口中, 按 Ctrl + 上箭头, 展开关闭的客人小窗口.');
		TableRow('<font class=grey>5)</font>&nbsp;&nbsp;客服窗口中, 按 Ctrl + 左或右箭头, 在已展开的客人小窗口间切换.');
		TableRow('<font class=grey>6)</font>&nbsp;&nbsp;客服窗口中, 客人被踢出或禁言后, 刷新页面仍可重新进入客服, 即此两项操作仅作用于当前对话.');
		TableRow('<font class=grey>7)</font>&nbsp;&nbsp;WeLive默认安装后, 前台客服小面板不会自动展开, 即不会进入客服. 如何希望自动展开, 可在系统设置中设置. <span class=note>自动展开会消耗服务器资源</span>');
		TableRow('<font class=grey>8)</font>&nbsp;&nbsp;移动端客服登录地址: <span class=note>' . BASEURL . 'app/</span>, 后台管理及客服登录目录admin或app均可任修改.');
		TableRow('<font class=grey>9)</font>&nbsp;&nbsp;在客服窗口中的客服交流区, 管理员可发送特殊指令: system die --- Socket服务将中断并重启(<span class=note>慎用</span>);&nbsp;&nbsp;all --- 显示所有连接数;&nbsp;&nbsp;admin --- 显示所有客服及其客人数;&nbsp;&nbsp;guest --- 显示客人数;&nbsp;&nbsp;robot --- 显示机器人服务数据');

		TableFooter();

		//更新顶部提示信息
		echo '<script type="text/javascript">
			$(function(){
				var info_total = ' . $basedata['new_comments'] . ';

				if(info_total > 0){
					$("#topuser dl#info_all").removeClass("none");
					$("#topuser #info_total").html(info_total);
					$("#topuser #info_comms").html(info_total).attr("class", "orangeb");

				}

				//将统计数据保存为cookie. 注: header已发送, 此页面不能使用php保存cookie
				setCookie("' . COOKIE_KEY . 'backinfos", info_total, 365);
			});
		</script>';
    }

	/**
	 * 文件夹大小
	 * @param $path
	 * @return int
	 */
	private function dirsize($path)
	{
		$size = 0;
		$handle = opendir($path);
		while (($item = readdir($handle)) !== false) {
			if ($item == '.' || $item == '..') continue;
			$_path = $path . '/' . $item;
			if (is_file($_path)) $size += filesize($_path);
			if (is_dir($_path)) $size += $this->dirsize($_path);
		}
		closedir($handle);
		return $size;
	}


}

?>