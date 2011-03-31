
/** 
 * class Output
 * 
 * @return 
 */
function Output()
{

}

/** 
 * 新建input的HTML,如果指定了target则直接append其中.
 * 
 * @param name
 * @param value
 * @param $target
 * 
 * @return 
 */
Output.prototype.makeInputHTML = function(name, value, $target)
{
  var $new_input = $('<input type="hidden"></input>');
  $new_input.attr('name',name);
  $new_input.attr('value',value);
  if ($target && $target.length != 0) {
	$target.append($new_input);
  }
  $new_input = null;
}

