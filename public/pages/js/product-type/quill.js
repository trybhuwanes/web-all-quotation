"use strict";
var KTProductsAddProduct = (function () {
    const t = document.getElementById("kt_form_create_product"),
        e = t.querySelector("#kt_create_product_form"),
        i = e.querySelector('[data-kt-product-action="submit"]');

        const n = (e) => {
            const quillContainer = document.getElementById("kt_inbox_form_editor");
            
        
            const quill = new Quill(quillContainer, {
                modules: {
                    toolbar: [
                        [{ header: [1, 2, false] }],
                        ["bold", "italic", "underline", "image"],
                        [{ list: "ordered" }, { list: "bullet" }]
                    ]
                },
                placeholder: "Tulis deskripsi disini...",
                theme: "snow"
            });
        
            const t = e.querySelector(".ql-toolbar");
            if (t) {
                const e = ["px-5", "border-top-0", "border-start-0", "border-end-0"];
                t.classList.add(...e);
            }
        
            e.addEventListener('submit', (event) => {
                var editorElement = document.querySelector('.ql-editor');
                console.log(editorElement);
                if (editorElement) {
                    const messageContent = editorElement.innerHTML;
                    console.log(messageContent);
                    document.getElementById('messageContent').value = messageContent; // Simpan ke input tersembunyi
                } else {
                    console.error("Quill editor content not found!");
                }
            });
        };

    return {
        init: function () {
            (() => {
                Dropzone.autoDiscover = false;
                new Dropzone("#kt_modal_create_product_galery", {
                    url: route('storage-dropzone-img'),
                    paramName: "file",
                    maxFiles: 3,
                    maxFilesize: 2,
                    addRemoveLinks: true,
                    acceptedFiles: "image/jpeg,image/png,image/gif,image/jpg",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                });
            })();

            this.initKategoriProductSelect2();
            const r = document.querySelector("#kt_inbox_compose_form");
            n(r);
        },

        initKategoriProductSelect2: function () {
            const url = route("select2.item-category");
            $("#product-category").select2(this.parentSelect2Options(url));
            
            let current_category = $("#current-category").val();

            if (current_category) {
                let category = JSON.parse(kategori_barang);

                var newOption = new Option(category.nama_kategori, category.id, false, true);
                $('#product-category').append(newOption).trigger('change');
            }
        },

        parentSelect2Options: function (url) {
            const options = {
                ajax: {
                    url: url,
                    dataType: "json",
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            page: params.page,
                        };
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;

                        return {
                            results: data,
                            pagination: {
                                more: params.page * 10 < data.total_count,
                            },
                        };
                    },
                    cache: true,
                },
                dropdownParent: "#kt_create_product_form",
            };

            return options;
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTProductsAddProduct.init();
});
