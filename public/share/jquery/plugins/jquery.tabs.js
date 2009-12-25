//
// create closure
//
(function($) {
  //
  // plugin definition
  //
  $.fn.tabsExtra = function(options) {
    debug(this);
    // build main options before element iteration
    var opts = $.extend({}, $.fn.tabsExtra.defaults, options);
    // iterate and reformat each matched element
    return this.each(function() {
      $this = $(this);
      // build element specific options
      var o = $.meta ? $.extend({}, opts, $this.data()) : opts;
      // update element styles
	  if (o.reload == true) {
		var $setTab = $this;
		var tab_index = $setTab.tabs('option', 'selected');
		$setTab.tabs('load',tab_index).tabs('select',tab_index);
	  }
	 
    });
  };
  //
  // private function for debugging
  //
  function debug($obj) {
    if (window.console && window.console.log)
	{}
  };
  //
  // define and expose our format function
  //
  $.fn.tabsExtra.reload = function($tab) {
  
  };
  //
  // plugin defaults
  //
  $.fn.tabsExtra.defaults = {
  };
//
// end of closure
//
})(jQuery); 
