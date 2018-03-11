/**
 * ajax 上传带进度条
 */
var xhr = new XMLHttpRequest();
            var clock = null;

function fire(){
        clock = window.setInterval(upfile,1000); //每一秒触发一次upfile函数
}

var upfile = (function(){
const LENGTH = 10 * 1024 * 1024; //定义每一次分割的文件的大小
var start = 0;
var end = start+LENGTH;
var fd = null;
var flag = false; //flag标志当前是否有文件在上传中
var percent = 0;

return (function(){
    /*如果有文件在上传则不进行操作,因为上次没传完就开始下次时会导致合并的文件衔接不上*/
    if(flag == true){ 
        return;
    }

    var file = document.getElementsByName('file')[0].files[0];

    if(start>file.size){ //所有分块上传完成跳出函数清除计数器
        clearInterval(clock);
        return;
    }

    blob = file.slice(start,end); //每10M分割一次文件

    fd = new FormData();
    fd.append('fragment',blob);

    up(fd);
    /*监听上传过程,定时器触发upfile函数时若是flag为true则不进行操作以免文件上传合并的时候出问题*/
    xhr.upload.onprogress = function(ev){
        if(ev.loaded<LENGTH){
            flag = true;
        }
    }
    percent = 100 * end / file.size;
    if(percent>100){
        percent = 100;
    }
    document.getElementById('sub').style.width = percent + '%';
    document.getElementById('sub').innerHTML = parseInt(percent)+ '%';

    start = end;
    end = start + LENGTH ;
    flag = false; //当前分块上传完成,flag置false

});


})();

function up(fd){
        //采用同步上传防止文件写入时顺序出错
        xhr.open('POST','./11.php',false);
        xhr.send(fd);
}
