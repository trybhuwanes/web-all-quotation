"use strict";

var KTAppInboxCompose = function() {
    const n = e => {
        new Quill("#kt_inbox_form_editor", {
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, !1]
                    }],
                    ["bold", "italic", "underline"],
                    [{ list: "ordered" }, { list: "bullet" }]
                ]
            },
            placeholder: "Tulis hasil diskusi disini...",
            theme: "snow"
        });
        const t = e.querySelector(".ql-toolbar");
        if (t) {
            const e = ["px-5", "border-top-0", "border-start-0", "border-end-0"];
            t.classList.add(...e);
        }
    };

    return {
        init: function() {
            const r = document.querySelector("#kt_inbox_compose_form");
            n(r);
            // console.log(r);
        }
    }
}();

KTUtil.onDOMContentLoaded((function() {
    KTAppInboxCompose.init()
}));
