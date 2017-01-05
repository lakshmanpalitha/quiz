function addEditor (selector) {
	var selector = selector;
	tinymce.init({
	  selector: selector,
	  height: 100,
	  plugins: 'link image code',
	  relative_urls: false
	});
}

// BAD
$( document ).ready(function() {
	var answererID = 2;
 

tinymce.init({
  selector: '.editor',
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code',
	'image'
  ],
  toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  
  image_title: true, 
  automatic_uploads: true,
  // URL of our upload handler (for more details check: https://www.tinymce.com/docs/configure/file-image-upload/#images_upload_url)
  images_upload_url: 'postAcceptor.php',
  file_picker_types: 'image', 
  file_picker_callback: function(cb, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');

    input.onchange = function() {
      var file = this.files[0];
      var id = 'blobid' + (new Date()).getTime();
      var blobCache = tinymce.activeEditor.editorUpload.blobCache;
      var blobInfo = blobCache.create(id, file);
      blobCache.add(blobInfo);
      
      cb(blobInfo.blobUri(), { title: file.name });
    };
    
    input.click();
  }
});
	

	$( ".add-answer" ).click(function() {
		var answererBlock = '<div class="answerer answerer-'+answererID+'"><div class="form-group col-md-6">' +
		'<textarea id="answerer-'+answererID+'" name="answerer-'+answererID+'" class="form-control editor" placeholder="Answerers"></textarea>' +
		'</div><div class="form-group col-md-3"><input id="mark-'+answererID+'" name="mark-'+answererID+'" class="form-control" placeholder="Marks">' +
		'</div> <div class="pull-right action-buttons col-md-3"><a href="#" class="trash delete-'+answererID+'">' +
		'<svg class="glyph stroked trash"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-trash"></use></svg>'+
		'</a></div></div>';
		$( ".answerers" ).append(answererBlock);		
		//addEditor("#answerer-"+answererID+"");
		console.log($("#answerer-"+answererID));
		
		tinymce.execCommand('mceAddEditor', false, "answerer-"+answererID);
		answererID = answererID + 1;
	});
	

	$( ".answerers-panel" ).on( "click","a.trash", function(event) {
		event.preventDefault();
		$(this).parents( ".answerer" ).remove();
	});
 
});


