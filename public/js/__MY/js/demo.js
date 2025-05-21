(function(g,i,z,m,o,e,s){
    var me;if(!i[g]) {console.error('module %s incorrectly called.',z.currentScript.src);return}me=i[g];
	/** define your module here: "me" will be the namespace variable, and "g" has the namespace name in it.
	 * use me.define to your module.
	 * if you return a function that function become the factory function to call when this module is required. the factory function is only called once.
	 * if you return an object, that object becomes the object returned when this module is required.
	 */
	/* begin: define */
    me.define('demo',['jquery'],function($){
		return function() {
			$('body').append('<p>Hello World! my namespace is <b>'+g+'</b></p>');
		}
    });
    /** end: define. */
})((new URL(document.currentScript.src)).hash.replace(/^#/,''),window,document);