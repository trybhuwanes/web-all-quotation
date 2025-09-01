"use strict"
var KTUsersList = function() {
    return {
        route : 'admin.laporan',
        dataTable : $("#kt_table_report"),  // Mengganti selector sesuai dengan tabel di Blade
        inputSearch : $('[data-kt-user-table-filter="search"]'),
        btnFilter : $('#btnFilter'),
        btnReset : $('#btnReset'),
        filterInput : {
            date : $('#filter_date'),
            purchaseType : $('#purchase-type'),
        },
        init: function() {
            this.initFilterDate(this.filterInput.date);
            this.selectedParams(()=>{
                    this.filterChange();
                    this.handleBeforeExport();
            });
        },
        initFilterDate: function (selector) {
            return selector.flatpickr({
                mode: "range",
                altInput: true,
                altFormat: "d F Y",
                dateFormat: "Y-m-d",
            })
        },
        searching: function(q) {
            console.log(`searching for ${q}...`)
            const currentParams = route().params
            delete currentParams.q
            const params = {
                q,
                ...currentParams,
            }
            const url = route(`${this.route}.index`, params)
            window.location.href =  url;
        },
        filtering: function () {
            const filter = {}

            if(this.filterInput.date.val()){
                filter.date = this.filterInput.date.val();
            }

            if(this.filterInput.purchaseType.val()){
                filter.purchase_type = this.filterInput.purchaseType.val();
            }
            const currentParams = route().params
            delete currentParams.filter
            const params = {
                filter,
                ...currentParams,
            }
            const url = route(`${this.route}.index`, params)
            window.location.href = url;
        },
        reset: function () {
            const currentParams = route().params
            delete currentParams.filter
            const params = {
                ...currentParams,
            }
            const url = route(`${this.route}.index`, params)
            window.location.href = url;
        },
        selectedParams: function (callback=null) {
            const currParams = route().params;
            if(currParams.filter){
                if(currParams.filter.date){
                    const dateRange  = KTGlobal().splitRangeDate(currParams.filter.date);
                    this.initFilterDate(this.filterInput.date).setDate(dateRange);
                }

                if(currParams.filter.purchase_type){
                    this.setSelectedParams(this.filterInput.purchaseType, currParams.filter.purchase_type, currParams.filter.purchase_type)
                }
            }

            if(callback){
                callback();
            }
        },
        exportExcel: function () {
            const currentParams = route().params;
            const params = {
                ...currentParams,
            };
            const url = route(`${this.route}.export-excel`, params)
            window.location.href = url;
        },
        setSelectedParams: function (jqEl, id, name) {
            const newOption = new Option(name, id, true, true);
            jqEl.append(newOption).trigger('change');
        },
        filterChange: function () {
            if(this.filterInput.date.val() && this.filterInput.purchaseType.val()){
                this.btnFilter.prop('disabled', false);
            }else{
                this.btnFilter.prop('disabled', true);
            }
        },
        handleBeforeExport: function () {
            const currentParams = route().params;
            const isDisabled = Object.keys(currentParams).length === 0;
        
            $('.export').prop('disabled', isDisabled);
        },
    }
}()

KTUtil.onDOMContentLoaded((function() {
    KTUsersList.init()

    // searching
    KTUsersList.inputSearch.on("keypress", function (t) {
        if (t.key === "Enter") {
            KTUsersList.searching(t.target.value);
        }
    });

    KTUsersList.filterInput.date.on("change", function () {
        KTUsersList.filterChange();
    });

    KTUsersList.filterInput.purchaseType.on("select2:select select2:clear", function () {
        KTUsersList.filterChange();
    });

    KTUsersList.btnFilter.on("click", function () {
        KTUsersList.filtering();
    });
    KTUsersList.btnReset.on("click", function () {
        KTUsersList.reset();
    });
    
    $('[data-kt-ecommerce-export="excel"]').on("click", function () {
        KTUsersList.exportExcel();
    })
}))
