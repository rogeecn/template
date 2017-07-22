tinymce.init({
    selector: "#{id}",
    height: 300,
    branding: false,
    plugins: [
        "advlist link image lists charmap hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media",
        "table template textcolor textpattern codesample"
    ],

    toolbar: [
        "bold italic underline strikethrough  bullist numlist | blockquote link unlink anchor image media | insertdatetime | table hr  charmap | visualchars visualblocks template pagebreak | searchreplace removeformat | codesample restoredraft code fullscreen"
    ],
    content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tinymce.com/css/codepen.min.css'
    ],
    menubar: false,
    toolbar_items_size: 'small',
    automatic_uploads: true,
    images_upload_url: '/plugin/tinymce_upload',
    file_picker_types: 'image',
    file_picker_callback: function (cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        //input.setAttribute('name', 'ajax-file-upload');
        input.setAttribute('accept', 'image/*');

        // Note: In modern browsers input[type="file"] is functional without
        // even adding it to the DOM, but that might not be the case in some older
        // or quirky browsers like IE, so you might want to add it to the DOM
        // just in case, and visually hide it. And do not forget do remove it
        // once you do not need it anymore.

        input.onchange = function () {
            var file = this.files[0];

            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function () {
                // Note: Now we need to register the blob in TinyMCEs image blob
                // registry. In the next release this part hopefully won't be
                // necessary, as we are looking to handle it internally.
                var id = 'blobid' + (new Date()).getTime();
                var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                var base64 = reader.result.split(',')[1];
                var blobInfo = blobCache.create(id, file, base64);
                blobCache.add(blobInfo);

                // call the callback and populate the Title field with the file name
                cb(blobInfo.blobUri(), {title: file.name});
            };
        };

        input.click();
    }
});
