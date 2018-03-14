首页标签
============================

标签名称：nav
--------------------------------------------------

功能说明：获取导航菜单列表

适用范围：全局使用

基本语法：
<{Cms:nav parent_id="0" orderby="rank asc" limit="10" item="vo" key="k" }>
	<a href="<{url link="contents/Cat/index" vars="id=$vo[cat_id]" suffix='true' domain='true'}>">
		<{$vo.cat_name}>
	</a>
<{/Cms:nav}>
参数说明：
parent_id 父id【必选】
orderby 排序方式 【必选】 可使用  cat_id asc 或者 rank asc 或者 cat_id desc 或者 rank desc
limit 查询数量【必选】 可使用范围 1-100 之间的任意数字
item 循环变量v【必选】 一般情况下默认为 vo 不需要修改 
key 循环变量k 【必选】 一般为默认为k 不需要修改 

标签名称：column
--------------------------------------------------

功能说明：获取文章列表

适用范围：全局使用

基本语法：

<{Cms:column limit="10" images="true" cat_id="0" orderby="add_time desc" item="vo" key="k" }>

		时间:<{$vo.add_time|date='Y-m-d H:i:s'}>
		
		标题:<a href="<{url link="contents/Contents/index" vars="id=$vo[id]" suffix="true " domain="true "}>" title="<{$vo.title}>">
		<{$vo.title|mb_truncation=12}></a>
		
		缩率图:<img src="<{$vo.images|aimg}>" />
		
		描述:<{$vo.description}>
		
		作者:<{$vo.author}>
		
		来源:<{$vo.source}>
		
		关键词:<{$vo.keywords}>

<{/Cms:column}>	
参数说明：
limit 查询数量【必选】 可使用范围 1-100 之间的任意数字
orderby 排序方式 【必选】 可使用  cat_id asc 或者 rank asc 或者 cat_id desc 或者 rank desc
item 循环变量v【必选】 一般情况下默认为 vo 不需要修改 
key 循环变量k 【必选】 一般为默认为k 不需要修改 
cat_id 【必选】大于等于0的整数
images【可选】 true 或者 false

标签名称：hotcolumn
--------------------------------------------------

功能说明：通过统计排序获取文章列表

适用范围：全局使用

基本语法：

<{Cms:hotcolumn limit="16" orderby="click asc" item="vo" key="k"}>
		时间:<{$vo.add_time|date='Y-m-d H:i:s'}>
		
		标题:<a href="<{url link="contents/Contents/index" vars="id=$vo[id]" suffix="true " domain="true "}>" title="<{$vo.title}>">
		<{$vo.title|mb_truncation=12}></a>
		
		缩率图:<img src="<{$vo.images|aimg}>" />
		
		描述:<{$vo.description}>
		
		作者:<{$vo.author}>
		
		来源:<{$vo.source}>
		
		关键词:<{$vo.keywords}>

<{/Cms:hotcolumn}>

参数说明：
limit 查询数量【必选】 可使用范围 1-100 之间的任意数字
orderby 排序方式 【必选】 可使用  click asc 或者 click desc 或者 comment desc 或者 comment asc 或者 praise desc 或者 praise asc 
item 循环变量v【必选】 一般情况下默认为 vo 不需要修改 
key 循环变量k 【必选】 一般为默认为k 不需要修改 
cat_id 【必选】大于等于0的整数


标签名称：sgpage
--------------------------------------------------

功能说明：获取单页列表

适用范围：全局使用

基本语法：
<{Cms:sgpage limit="10" orderby="rank asc" limit="10" item="vo" key="k" }>
	<a href="<{url link="contents/SinglePage/index" vars="id=$vo[id]" suffix='true' domain='true'}>">
		<{$vo.title}>
	</a>
<{/Cms:sgpage}>
参数说明：
limit 查询数量【必选】 可使用范围 1-100 之间的任意数字
orderby 排序方式 【必选】 可使用  id asc 或者 id desc 或者 add_time desc 或者 add_time asc 或者 rank desc 或者 rank asc 

标签名称：friendlink
--------------------------------------------------

功能说明：获取友情链接列表

适用范围：全局使用

基本语法：
<{Cms:friendlink limit="100" orderby="rank asc" item="vo" key="k"}>
<a href='<{$vo.url}>' target='_blank'><{$vo.title}></a> &nbsp;|&nbsp; 
<{/Cms:friendlink}>
</div>
参数说明：
limit 查询数量【必选】 可使用范围 1-100 之间的任意数字
orderby 排序方式 【必选】 可使用   rank desc 或者 rank asc 
item 循环变量v【必选】 一般情况下默认为 vo 不需要修改 
key 循环变量k 【必选】 一般为默认为k 不需要修改 

标签名称：friendlink
--------------------------------------------------

功能说明：获取友情链接列表

适用范围：全局使用

基本语法：
<{Cms:friendlink limit="100" orderby="rank asc" item="vo" key="k"}>
<a href='<{$vo.url}>' target='_blank'><{$vo.title}></a> &nbsp;|&nbsp; 
<{/Cms:friendlink}>
</div>
参数说明：
limit 查询数量【必选】 可使用范围 1-100 之间的任意数字
orderby 排序方式 【必选】 可使用   rank desc 或者 rank asc 
item 循环变量v【必选】 一般情况下默认为 vo 不需要修改 
key 循环变量k 【必选】 一般为默认为k 不需要修改 

标签名称：ad
--------------------------------------------------

功能说明：获取一条广告

适用范围：全局使用

基本语法：
<{Cms:ad limit="1" cat_id="0" ad_type="aimg" orderby="add_time desc" /}>
参数说明：
limit 查询数量【必选】 可使用范围 1-100 之间的任意数字
orderby 排序方式 【必选】 可使用   rank desc 或者 rank asc 
ad_type 广告类型 【必选】 可使用   aimg 或者 code 或者 text 或者 imgs
cat_id 广告投放栏目【必选】 可使用范围 1-100 之间的任意数字

标签名称：config
--------------------------------------------------

功能说明：获取一条全局配置参数

适用范围：全局使用

基本语法：
<{Cms:config code="cfg_contents_qq1" /}>
参数说明：
code 变量code【必选】 全局参数中的code