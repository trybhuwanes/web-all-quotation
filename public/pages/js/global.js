"use strict";
var KTGlobal = function () {
    return {
        swalDefaultOptions: function ({
            title = null,
            text,
            icon,
            buttonsStyling = false,
        }) {
            return {
                title,
                text,
                icon,
                buttonsStyling,
            };
        },
        swal: function ({
            title = null,
            text,
            icon,
            additionalOptions = {},
            reloadUrl = null,
            modalSelector = null,
            callback = null,
        }) {
            const options = {
                ...KTGlobal().swalDefaultOptions({ title, text, icon }),
                ...additionalOptions,
            };

            Swal.fire({ ...options }).then(function (t) {
                t.isConfirmed && $(modalSelector).modal("hide");

                if (reloadUrl) {
                    window.location.href = reloadUrl;
                }

                // callback confirm
                if (callback) {
                    if (t.value) {
                        callback();
                    }
                }
            });
        },
        swalFormSubmitted: function ({
            reloadUrl = null,
            modalSelector = null,
        }) {
            KTGlobal().swal({
                // text: translate('common.form_has_submitted'),
                icon: "success",
                additionalOptions: {
                    confirmButtonText: "Ok, lanjutkan!",
                    customClass: {
                        confirmButton: "btn btn-primary",
                    },
                },
                reloadUrl,
                modalSelector,
            });
        },
        swalDeletedSelectedItems: function ({ reloadUrl = null }) {
            KTGlobal().swal({
                // text: translate('common.item_has_deleted'),
                icon: "success",
                additionalOptions: {
                    confirmButtonText: "Ok, lanjutkan!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    },
                },
                reloadUrl,
            });
        },
        swalDeletedItem: function ({ item = null, reloadUrl = null }) {
            KTGlobal().swal({
                // text: translate('common.item_x_has_deleted', { x: item }),
                icon: "success",
                additionalOptions: {
                    confirmButtonText: "Ok, lanjutkan!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    },
                },
                reloadUrl,
            });
        },
        cancelForm: function (selectors, t, resetFormMethod, n) {
            $(selectors).bind("click", (t) => {
                t.preventDefault(),
                    Swal.fire({
                        text: `Apakah anda yakin ingin membatalkan?`,
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Ya",
                        cancelButtonText: "Batal",
                        customClass: {
                            confirmButton: "btn btn-primary",
                            cancelButton: "btn btn-active-light",
                        },
                    }).then(function (t) {
                        t.value
                            ? (resetFormMethod(), n.hide())
                            : "cancel" === t.dismiss &&
                              Swal.fire({
                                  text: `Dibatalkan`,
                                  icon: "error",
                                  buttonsStyling: !1,
                                  confirmButtonText: "Ok, lanjutkan!",
                                  customClass: {
                                      confirmButton: "btn btn-primary",
                                  },
                              });
                    });
            });
        },
        deleteSelectedItems: function ({
            url,
            selectedItemIds = [],
            reloadUrl = null,
        }) {
            Swal.fire({
                // text: translate('common.confirm_delete_selected_items'),
                icon: "warning",
                showCancelButton: !0,
                buttonsStyling: !1,
                confirmButtonText: "Ya",
                cancelButtonText: "Batal",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary",
                },
            }).then(function (t) {
                if (t.value) {
                    axios
                        .post(url, { id: selectedItemIds })
                        .then(({ data }) => {
                            if (data.success) {
                                KTGlobal().swalDeletedSelectedItems({
                                    reloadUrl,
                                });
                            }
                        });
                }
            });
        },
        deleteItem: function ({ url, item = null, reloadUrl = null }) {
            Swal.fire({
                icon: "warning",
                showCancelButton: !0,
                buttonsStyling: !1,
                confirmButtonText: "Ya",
                cancelButtonText: "Batal",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary",
                },
            }).then(function (t) {
                if (t.value) {
                    axios.delete(url).then(({ data }) => {
                        if (data.success) {
                            KTGlobal().swalDeletedItem({ item, reloadUrl });
                        }
                    });
                }
            });
        },
        toast: function (title, text, type = "info", bsDelay = 5000) {
            let icon = [];
            icon["success"] = '<i class="fa fa-check-circle"></i>';
            icon["danger"] = '<i class="fa fa-times-circle"></i>';
            icon["warning"] = '<i class="fa fa-exclamation-circle"></i>';
            icon["info"] = '<i class="fa fa-info-cirle"></i>';

            let bg = [];
            bg["success"] = "bg-success";
            bg["danger"] = "bg-danger";
            bg["warning"] = "bg-warning";
            bg["info"] = "bg-primary";

            const d = new Date();
            let h = d.getHours();
            let m = d.getMinutes();
            let s = d.getSeconds();
            let time = h + ":" + m + ":" + s;

            const button = document.getElementById(
                "kt_docs_toast_stack_button"
            );
            const container = document.getElementById(
                "kt_docs_toast_stack_container"
            );
            const targetElement = document.querySelector(
                '[data-kt-docs-toast="stack"]'
            ); // Use CSS class or HTML attr to avoid duplicating ids

            // Remove base element markup
            // targetElement.parentNode.removeChild(targetElement);

            // window.event.preventDefault();

            // Create new toast element
            const newToast = targetElement.cloneNode(true);
            newToast.setAttribute("data-bs-delay", bsDelay);
            newToast.classList.add(bg[type]);
            newToast.querySelector(".toast .toast-header strong").innerHTML =
                title;
            newToast.querySelector(".toast .toast-header small").innerHTML =
                '<i class="fa fa-clock me-2"></i>' + time;
            newToast.querySelector(".toast .toast-header .svg-icon").innerHTML =
                icon[type];
            newToast.querySelector(".toast .toast-body").innerHTML = text;

            container.append(newToast);

            // Create new toast instance --- more info: https://getbootstrap.com/docs/5.1/components/toasts/#getorcreateinstance
            const toast = bootstrap.Toast.getOrCreateInstance(newToast);

            // Toggle toast to show --- more info: https://getbootstrap.com/docs/5.1/components/toasts/#show
            toast.show();
        },
        formatMoney: function (a, c, currency = "Rp", d, t) {
            // a = 47000
            // c = 2
            // d = ,
            // t = .
            // result = 47.000,00
            var n = a,
                c = isNaN((c = Math.abs(c))) ? 0 : c,
                d = d == undefined ? "," : d,
                t = t == undefined ? "." : t,
                s = n < 0 ? "-" : "",
                i = parseInt((n = Math.abs(+n || 0).toFixed(c))) + "",
                j = (j = i.length) > 3 ? j % 3 : 0;
            return (
                s +
                currency +
                (j ? i.substr(0, j) + t : "") +
                i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) +
                (c
                    ? d +
                      Math.abs(n - i)
                          .toFixed(c)
                          .slice(2)
                    : "")
            );
        },
        formatNumber: function (a, c, d, t) {
            var n = a,
                c = isNaN((c = Math.abs(c))) ? 0 : c,
                d = d == undefined ? "," : d,
                t = t == undefined ? "." : t,
                s = n < 0 ? "-" : "",
                i = parseInt((n = Math.abs(+n || 0).toFixed(c))) + "",
                j = (j = i.length) > 3 ? j % 3 : 0;
            return (
                s +
                (j ? i.substr(0, j) + t : "") +
                i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) +
                (c
                    ? d +
                      Math.abs(n - i)
                          .toFixed(c)
                          .slice(2)
                    : "")
            );
        },
        handleModalPin: function (modalSelector) {
            modalSelector.on("shown.bs.modal", function () {
                pin1.focus();
            }),
                (pin1 = modalSelector.find("[name=pin_1]")),
                (pin2 = modalSelector.find("[name=pin_2]")),
                (pin3 = modalSelector.find("[name=pin_3]")),
                (pin4 = modalSelector.find("[name=pin_4]")),
                (pin5 = modalSelector.find("[name=pin_5]")),
                (pin6 = modalSelector.find("[name=pin_6]")),
                pin1.on("keyup", function () {
                    1 === this.value.length && pin2.focus();
                }),
                pin2.on("keyup", function (e) {
                    e.keyCode == 8
                        ? pin1.focus()
                        : 1 === this.value.length && pin3.focus();
                }),
                pin3.on("keyup", function (e) {
                    e.keyCode == 8
                        ? pin2.focus()
                        : 1 === this.value.length && pin4.focus();
                }),
                pin4.on("keyup", function (e) {
                    e.keyCode == 8
                        ? pin3.focus()
                        : 1 === this.value.length && pin5.focus();
                }),
                pin5.on("keyup", function (e) {
                    e.keyCode == 8
                        ? pin4.focus()
                        : 1 === this.value.length && pin6.focus();
                }),
                pin6.on("keyup", function (e) {
                    if (e.keyCode == 8) pin5.focus();
                });
        },
        clearModalPinForm: function () {
            pin1.val(""),
                pin2.val(""),
                pin3.val(""),
                pin4.val(""),
                pin5.val(""),
                pin6.val("");
            pin1.focus();
        },
        errorsBag: function (errorBags) {
            const errorKeys = Object.keys(errorBags);
            const singleErrorKeys = errorKeys.filter(
                (v) => v.indexOf(".") == -1
            );
            const arrayErrorKeys = errorKeys.filter(
                (v) => v.indexOf(".") !== -1
            );
            // console.log(singleErrorKeys);
            // console.log(arrayErrorKeys);

            singleErrorKeys.forEach((v, i) => {
                $(`#error-${v}`).text(errorBags[v]);
            });

            arrayErrorKeys.forEach((v, i) => {
                let splitted = v.split(".");
                if (splitted.length == 2) {
                    let [index, errKey] = v.split(".");
                    $(`.error-${errKey}:eq(${index})`).text(errorBags[v]);
                } else if (splitted.length == 3) {
                    let [varName, index, errKey] = v.split(".");
                    console.log(`.error-${varName}-${errKey}:eq(${index})`);
                    $(`.error-${varName}-${errKey}:eq(${index})`).text(
                        errorBags[v]
                    );
                    console.log(`.error-${varName}-${errKey}:eq(${index})`);
                } else if (splitted.length == 5) {
                    // console.log(splitted);
                    let [varName, index, subVarName, errKey, fields] =
                        v.split(".");
                    // console.log(`.error-${varName}-${subVarName}-${fields}:eq(${parseInt(index)+parseInt(errKey)})`);
                    $(
                        `.error-${varName}-${subVarName}-${fields}:eq(${
                            parseInt(index) + parseInt(errKey)
                        })`
                    ).text(errorBags[v]);
                }
            });
        },
        resetErrorbags: function () {
            $(".invalid-feedback").each(function () {
                $(this).text("");
            });
        },
        splitRangeDate: function (dateRange) {
            if (
                !dateRange ||
                !decodeURIComponent(dateRange).indexOf("to") == -1
            ) {
                return null;
            }
            return decodeURIComponent(dateRange)
                .split("to")
                .map((item) => {
                    return item.trim();
                });
        },
        openCenteredNewWindo: function (url) {
            var dualScreenLeft =
                window.screenLeft != undefined
                    ? window.screenLeft
                    : window.screenX;
            var dualScreenTop =
                window.screenTop != undefined
                    ? window.screenTop
                    : window.screenY;

            var width = window.innerWidth
                ? window.innerWidth
                : document.documentElement.clientWidth
                ? document.documentElement.clientWidth
                : screen.width;
            var height = window.innerHeight
                ? window.innerHeight
                : document.documentElement.clientHeight
                ? document.documentElement.clientHeight
                : screen.height;

            var h = 595;
            var w = 842;

            var left = width / 2 - w / 2 + dualScreenLeft;
            var top = height / 2 - h / 2 + dualScreenTop;
            var microtime = (Date.now() % 1000) / 1000;
            window.open(
                url,
                microtime,
                "width=" +
                    w +
                    ",height=" +
                    h +
                    ",status=yes,toolbar=no,menubar=no, titlebar=no,re sizable=no,location=no,scrollbars=yes, top=" +
                    top +
                    ", left=" +
                    left
            );
        },
        alertFormError: function (
            errorMsg = "",
            title = "Oops!",
            bg = "bg-light-danger"
        ) {
            $("#form-error-wrapper").html(`
                <div id="form-error"
                    class="alert alert-dismissible ${bg} d-flex flex-column flex-sm-row p-5 form-error">
                    <span class="svg-icon svg-icon-2hx svg-icon-danger me-4 mb-5 mb-sm-0">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3"
                                d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
                                fill="currentColor" />
                            <rect x="9" y="13.0283" width="7.3536" height="1.2256" rx="0.6128"
                                transform="rotate(-45 9 13.0283)" fill="currentColor" />
                            <rect x="9.86664" y="7.93359" width="7.3536" height="1.2256" rx="0.6128"
                                transform="rotate(45 9.86664 7.93359)" fill="currentColor" />
                        </svg>
                    </span>
                    <div class="d-flex flex-column pe-0 pe-sm-10">
                        <h4 class="fw-semibold">${title}</h4>
                        <span id="form-error-message" class="text-gray-800 form-error-message">${errorMsg}</span>
                    </div>
                    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                        data-bs-dismiss="alert">
                        <span class="svg-icon svg-icon-1 svg-icon-danger">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                    transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                            </svg>
                        </span>
                    </button>
                </div>
            `);
        },
        chunkArrayInGroups: function (arr, size) {
            let myArray = [];
            for (let i = 0; i < arr.length; i += size) {
                myArray.push(arr.slice(i, i + size));
            }

            return myArray;
        },
    };
};

$(".form-submit-handler").on("submit", function (e) {
    const submitBtn = $(this).find('[type="submit"]');
    const block = `<span class="indicator-progress">
                        ${"Mohon Tunggu"}
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>`;

    submitBtn.prop("disabled", true);
    submitBtn.html(block);
    submitBtn.attr("data-kt-indicator", "on");
});
