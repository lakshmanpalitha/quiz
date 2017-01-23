



$(document).ready(function () {
    var answerID = 1;


    tinymce.init({
        selector: '.editor',
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code',
            'image'
        ],
        toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',

        image_title: true,
        automatic_uploads: true,
        // URL of our upload handler (for more details check: https://www.tinymce.com/docs/configure/file-image-upload/#images_upload_url)
        images_upload_url: 'postAcceptor.php',
        file_picker_types: 'image',
        //relative_urls : true,
       //document_base_url : "http://localhost/quiz/manager/",
        relative_urls : false,
        remove_script_host : false,
        convert_urls : true,
        file_picker_callback: function (cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            input.onchange = function () {
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

    $('.delete-btn').click(function(event){
        var confirmMsg = confirm("Are you sure ?? Do you want to Delete This ??");
        if (confirmMsg == true) {
            return true;
        } else {
            event.preventDefault();
        }
    })


    $('[data-toggle="tooltip"]').tooltip();

/*
//adding new answer box
    $(".add-answer").click(function () {
        var answerBlock = '<div class="answer answer-' + answerID + '"><div class="form-group col-md-6">' +
            '<textarea id="answer-' + answerID + '" name="answer-' + answerID + '" class="form-control editor" placeholder="answers"></textarea>' +
            '</div><div class="form-group col-md-3"><input id="mark-' + answerID + '" name="mark-' + answerID + '" class="form-control" placeholder="Marks">' +
            '</div> <div class="pull-right action-buttons col-md-3"><a href="#" class="trash delete-' + answerID + '">' +
            '<svg class="glyph stroked trash"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-trash"></use></svg>' +
            '</a></div></div>';
        $(".answers").append(answerBlock);
        //addEditor("#answer-"+answerID+"");
        console.log($("#answer-" + answerID));

        tinymce.execCommand('mceAddEditor', false, "answer-" + answerID);
        answerID = answerID + 1;
    });

//deleting answer box
    $(".answers-panel").on("click", "a.trash", function (event) {
        event.preventDefault();
        $(this).parents(".answer").remove();
    });
*/


//dome redy close
});


