
function BubbleBind() 
{
/** 
 * 利用冒泡绑定事件处理函数
 */
var bubbleBind = {

    //目标，捕捉冒泡的父DOM对象
    _target : '',

    //设置target,参数为jquery选择器形式
    setTarget: function(target) {
         this._target = target;
    }, 

    //绑定需要捕捉的事件
    //element: 需要捕捉的对象(触发事件的对象)，jquery选择器形式
    //type: 事件类型,jquery中bind函数的type参数
    //fn1: 回调函数，事件处理函数
    //fn2,fn3: 预留
    bind: function(element,type,fn1,fn2,fn3) {
         //没有设定target则抛出异常，没有目标无从绑定
         if (this._target == '') throw "target must be set up.";
         switch (type)
         { 
             //预留
             case '':
                break;
             default:
                //为大的目标对象绑定事件处理函数
                $(this._target).bind(
                    type,
                    function(e){
                    //e.target: 触发此次事件的对象(浏览器对象)
                    //element: 参数之一，需要绑定事件的对象
                    //console.log(e.target,'tar');
                    //console.log($(element),'ele');
                        //确认触发事件的对象为指定对象
                        if ($.inArray(e.target,$(element)) != -1) {
                            //此处为了方便直接传递的是jquery对象
                            fn1($(e.target))
                        }//fi
                }
                );
         }//end witch
    },//end bind

    //防止内存泄漏，删除所有属性和绑定在目标捕捉器上的事件处理函数
    unload: function(){
        $(this._target).unbind();
        for (i in this) {
           this[i] = null;
        } 
    }

};//end bubbleBind
    return bubbleBind;
}//end function

