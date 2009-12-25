
/** 
 * Class CommandFactory
 * 
 * @param commandType
 * 
 * @return 
 */
function CommandFactory(commandType)
{
  var command = ucwords(commandType);
  command += 'Command';

  //确认所请求的Command类是存在的
  if (eval('typeof ' + command + ' != "undefined"')) {
	return eval('new ' + command + '()');
  } else {
	//如果不存在,则返回一个超类做替代,超类不调用任何回调函数
	return new Command();
  }
}

