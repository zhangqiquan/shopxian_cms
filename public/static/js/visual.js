// JavaScript Document
var Visual={
	release:function(obj){
		var html=$(obj).parent().parent().find("textarea").val();
		var post_data={};
		$(".ui-sortable").find(".config_input").each(function(i){
//			var widgets_data_id=$(this).data("widgets_data_id");
//			var app_tpl_dir=$(this).data("app_tpl_dir");
//			var tpl_type=$(this).data("tpl_type");
//			var tpl_name_dir=$(this).data("tpl_name_dir");
//			var tpl_file_name=$(this).data("tpl_file_name");
//			var widgets_name=$(this).data("widgets_name");
//			var widgets_body=$(this).val();
			var this_data={
				'widgets_data_id':$(this).data("widgets_data_id"),
				'app_tpl_dir':$(this).data("app_tpl_dir"),
				'tpl_type':	$(this).data("tpl_type"),
				'tpl_name_dir':	$(this).data("tpl_name_dir"),
				'tpl_file_name':$(this).data("tpl_file_name"),
				'widgets_name':	$(this).data("widgets_name"),
				'widgets_body':	$(this).val()
			}
			post_data[i]=this_data;
			console.log($(this));
		})
		console.log(post_data);
		$.post(RELEASE_URL+'?type='+TPL_TYPE+'&tpl_file='+TPL_FILE,post_data,function(data){
			data=eval("("+data+")");
			if(data.status){
				if(confirm("发布成功,预览点击是,关闭点击否")){
					alert("预览");
				}else{
					window.close();
				}
			}else{
				alert(data.msg);	
			}
		});
	}
}