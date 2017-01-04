

// BAD
$( document ).ready(function() {
 
	 tinymce.init({
	  selector: '.category-details',
	  height: 230,
	  plugins: 'link image code',
	  relative_urls: false,
	  content_css: [
		'//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
		'//www.tinymce.com/css/codepen.min.css'
	  ]
	});
 
});
