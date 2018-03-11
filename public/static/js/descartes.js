//笛卡儿积组合  (针对商品多规格的乘机组合)
function descartes(list)  
{  
    //parent上一级索引;count指针计数  
    var point = {};  
    var result = [];  
    var pIndex = null;  
    var tempCount = 0;  
    var temp  = [];  
    //根据参数列生成指针对象  
    for(var index in list)  
    {  
        if(typeof list[index] == 'object')  
        {  
            point[index] = {'parent':pIndex,'count':0}  
            pIndex = index;  
        }  
    }  
    //单维度数据结构直接返回  
    if(pIndex == null)  
    {  
        return list;  
    }  
    //动态生成笛卡尔积  
    while(true)  
    {  
        for(var index in list)  
        {  
            tempCount = point[index]['count'];  
            temp.push(list[index][tempCount]);  
        }  
    //压入结果数组  
        result.push(temp);  
        temp = [];  
    //检查指针最大值问题  
        while(true)  
        {  
            if(point[index]['count']+1 >= list[index].length)  
            {  
                point[index]['count'] = 0;  
                pIndex = point[index]['parent'];  
                if(pIndex == null)  
                {  
                    return result;  
                }  
                //赋值parent进行再次检查  
                index = pIndex;  
            }else{  
                point[index]['count']++;  
                break;  
            }  
        }  
    }  
} 
/**
 * 使用实例
 * @type Array|descartes.result
 * var result = descartes({'颜色':['红','白','绿','紫'],'尺寸':['X','XL','XXL','XXXL'],'款式':['少女款','妇女款','老年款']});  
* console.log(result);
 */

