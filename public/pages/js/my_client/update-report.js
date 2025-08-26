"use strict";

var KTFormComposeClient = (function () {
    const formElement = document.getElementById("kt_inbox_compose_form"),
        submitButton = formElement.querySelector("#kt_diskusi_submit");

    const submitForm = () => {
        var editorElement = document.querySelector('.ql-editor');
        const messageContent = editorElement ? editorElement.innerHTML : '';

        // Ambil nilai dari input radio
        const nextTodo = formElement.querySelector('input[name="next_todo"]:checked');
        if (!nextTodo) {
            Swal.fire({
                text: "Anda harus memilih 'Next to do' sebelum menyimpan!",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "OK, mengerti!",
                customClass: {
                    confirmButton: "btn btn-primary",
                },
            });
            return;
        }

        // Kirim data ke server
        const url = formElement.getAttribute('action');
        let formData = new FormData(formElement);  // Ini akan otomatis mengambil semua input dalam form
        
        // Tambahkan data tambahan ke FormData
        formData.append('message', messageContent);
        formData.append('next_todo', nextTodo.value);

        submitButton.setAttribute("data-kt-indicator", "on");
        submitButton.disabled = true;

        for (let [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }

        axios.post(url, formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(({ data }) => {
            if (data.success) {
                Swal.fire({
                    text: "Data berhasil disimpan!",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Oke!",
                    customClass: {
                        confirmButton: "btn btn-primary",
                    },
                }).then(function (result) {
                    if (result.isConfirmed) {
                        window.location.href = '/pic/client';
                    }
                });
            }
        })
        .catch(({ response }) => {
            console.log(response);
            // Tangani kesalahan
            Swal.fire({
                text: "Terjadi kesalahan saat menyimpan data!",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Oke!",
                customClass: {
                    confirmButton: "btn btn-primary",
                },
            });
        })
        .finally(() => {
            submitButton.removeAttribute("data-kt-indicator");
            submitButton.disabled = false;
        });
    };

    return {
        init: function () {
            submitButton.addEventListener("click", function (event) {
                event.preventDefault();
                submitForm();
            });
        }
    };
})();

document.addEventListener("DOMContentLoaded", function () {
    KTFormComposeClient.init();
});
