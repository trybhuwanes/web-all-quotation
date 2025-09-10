"use strict";

var KTAppInboxCompose = function() {
    // Function to initialize a Quill editor
    const initQuill = (selector) => {
        new Quill(selector, {
            modules: {
                toolbar: [
                    [{ header: [1, 2, false] }],
                    ["bold", "italic", "underline", "image"],
                    [{ list: "ordered" }, { list: "bullet" }]
                ]
            },
            placeholder: "Tulis deskripsi di sini...",
            theme: "snow"
        });
    };

    return {
        init: function() {
            // Initialize Quill editor for Deskripsi
            initQuill("#deskripsi_editor");
        }
    };
}();

// Execute when the DOM is fully loaded
KTUtil.onDOMContentLoaded(function() {
    KTAppInboxCompose.init();
});
