var xhr;
var img1;
var input1;
$('.tagInput_img_up').change(function(){
    var parentparent=$(this).parent().parent();
    input1=parentparent.find('div').eq(0).find('input').eq(0);
    var url=$(this).data('url');
    fileObj=this.files[0];
    var form = new FormData();
    form.append("myfile", fileObj);
    if(window.ActiveXObject)
    {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    else if(window.XMLHttpRequest)
    {
        xhr = new XMLHttpRequest();
    }
    xhr.onreadystatechange = handleStateChange;
    xhr.open("post", url, true);
    xhr.send(form);
//    $.post(url,{'data':this.files[0]},function(data){
//        alert(data);
//    });
//    alert($(this).val());
//    alert(input1.val());
    img1=parentparent.find('div').eq(2).find('img').eq(0);
    
});
function handleStateChange()
    {
        if(xhr.readyState == 4)
        {
            if (xhr.status == 200 || xhr.status == 0)
            {
                var result = xhr.responseText;
                img1.css('display','');
                img1.attr('src',result);
                input1.val(result);
            }
        }
    }

