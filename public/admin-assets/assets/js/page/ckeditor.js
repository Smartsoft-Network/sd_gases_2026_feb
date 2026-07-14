'use strict';
$(function () {
  //CKEditor
  CKEDITOR.replace('ckeditor', {
    height: 300,
    removePlugins: 'exportpdf'
  });

  if (window.CodeMirror) {
    $(".codeeditor").each(function () {
      let editor = CodeMirror.fromTextArea(this, {
        lineNumbers: true,
        theme: "duotone-dark",
        mode: 'javascript',
        height: 200
      });
      editor.setSize("100%", 200);
    });
  }


});

