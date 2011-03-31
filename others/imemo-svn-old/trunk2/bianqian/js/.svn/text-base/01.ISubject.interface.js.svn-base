
/** 
 * interface ISubject
 * 
 * @return 
 */
function ISubject()
{
  this._ObserverList = [];
}

ISubject.prototype.addObserver = function(observer)
{
  this._ObserverList.push(observer);
  return this;
}

ISubject.prototype.delObserver = function(observer){} 

ISubject.prototype.notify = function(observer,msg)
{
  var msg = msg || {};
  for (i in this._ObserverList) {
	this._ObserverList[i].update(this,msg);
  }
  if (window.console && window.console.log) {
	console.log('notify at ' + new Date());
  }
} 

