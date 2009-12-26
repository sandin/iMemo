
/** 
 * 首字大写
 * 
 * @param str
 * 
 * @return 
 */
function ucwords(str)
{
  return str.replace(/\b\w+\b/g, function(word) {
	return word.substring(0,1).toUpperCase( ) +	word.substring(1);
	});
}

//http://hi.baidu.com/aaxh/blog/item/ef99b1fb8ef3da234e4aea2e.html
//
function arrayIndexOf(data,key)       /*JS暴虐查找*/
{
    var re = new RegExp(key,[""]);
    return (data.toString().replace(re,"|").replace(/[^,|]/g,"")).indexOf("|");
}


function LdsHelper(){};

// 将category_id:note_id这种形式的数组
// ["3:117", "3:112", "3:116", "3:113", "3:114", "3:115"]
// 解析成只有note_id或category_id的数组
// ["117", "112", "116", "113", "114", "115"]
LdsHelper.prototype.parseIdArray = function(arr,type)
{
    var a = arr.toString() + ',';
    switch (type)
    {
        case 'note_id':
            return a.match(/\d+(?!:)/g);
            break;
        case 'category_id':
            return a.match(/\d+(?!,)/g);
            break;
        default:
            return false;
    }
}
