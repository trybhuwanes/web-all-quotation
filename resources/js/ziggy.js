const Ziggy = {
    url: "http://127.0.0.1:8000",
    port: 8000,
    defaults: {},
    routes: {
        "sanctum.csrf-cookie": {
            uri: "sanctum/csrf-cookie",
            methods: ["GET", "HEAD"],
        },
        "ignition.healthCheck": {
            uri: "_ignition/health-check",
            methods: ["GET", "HEAD"],
        },
        "ignition.executeSolution": {
            uri: "_ignition/execute-solution",
            methods: ["POST"],
        },
        "ignition.updateConfig": {
            uri: "_ignition/update-config",
            methods: ["POST"],
        },
        "product-overview.specification": {
            uri: "product-overview/{slug}/specification",
            methods: ["GET", "HEAD"],
            parameters: ["slug"],
        },
        "product-overview.brosur": {
            uri: "product-overview/{slug}/download-brosur",
            methods: ["GET", "HEAD"],
            parameters: ["slug"],
        },
        "submit.count": { uri: "count", methods: ["POST"] },
        "admin.dashboard": { uri: "admin/dashboard", methods: ["GET", "HEAD"] },
        "admin.dashboard.getsales": {
            uri: "admin/dashboard/sales",
            methods: ["GET", "HEAD"],
        },
        "admin.dashboard.getsalespic": {
            uri: "admin/dashboard/salespic",
            methods: ["GET", "HEAD"],
        },
        "admin.dashboard.getorderstatus": {
            uri: "admin/dashboard/productsale",
            methods: ["GET", "HEAD"],
        },
        "admin.dashboard.getrevenuepic": {
            uri: "admin/dashboard/salerevenuepic",
            methods: ["GET", "HEAD"],
        },
        "alluser.index": { uri: "admin/alluser", methods: ["GET", "HEAD"] },
        "alluser.create": {
            uri: "admin/alluser/create",
            methods: ["GET", "HEAD"],
        },
        "alluser.store": { uri: "admin/alluser", methods: ["POST"] },
        "alluser.show": {
            uri: "admin/alluser/{alluser}",
            methods: ["GET", "HEAD"],
            parameters: ["alluser"],
        },
        "alluser.edit": {
            uri: "admin/alluser/{alluser}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["alluser"],
        },
        "alluser.update": {
            uri: "admin/alluser/{alluser}",
            methods: ["PUT", "PATCH"],
            parameters: ["alluser"],
        },
        "alluser.destroy": {
            uri: "admin/alluser/{alluser}",
            methods: ["DELETE"],
            parameters: ["alluser"],
        },
        "user-pic.create": {
            uri: "admin/user-pic/create",
            methods: ["GET", "HEAD"],
        },
        "user-pic.store": { uri: "admin/user-pic", methods: ["POST"] },
        "admin.update.pass": {
            uri: "admin/change-pass/{userid}",
            methods: ["PUT"],
            parameters: ["userid"],
        },
        "admin.update.mail": {
            uri: "admin/change-mail/{userid}",
            methods: ["PUT"],
            parameters: ["userid"],
        },
        "select2.item-category": {
            uri: "admin/select2/item-category",
            methods: ["GET", "HEAD"],
        },
        "select2.item-productmain": {
            uri: "admin/select2/item-product-main",
            methods: ["GET", "HEAD"],
        },
        "select2.item-pic": {
            uri: "admin/select2/item-pic",
            methods: ["GET", "HEAD"],
        },
        "kategori-product.index": {
            uri: "admin/kategori-product",
            methods: ["GET", "HEAD"],
        },
        "kategori-product.create": {
            uri: "admin/kategori-product/create",
            methods: ["GET", "HEAD"],
        },
        "kategori-product.store": {
            uri: "admin/kategori-product",
            methods: ["POST"],
        },
        "kategori-product.show": {
            uri: "admin/kategori-product/{kategori_product}",
            methods: ["GET", "HEAD"],
            parameters: ["kategori_product"],
        },
        "kategori-product.edit": {
            uri: "admin/kategori-product/{kategori_product}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["kategori_product"],
        },
        "kategori-product.update": {
            uri: "admin/kategori-product/{kategori_product}",
            methods: ["PUT", "PATCH"],
            parameters: ["kategori_product"],
        },
        "kategori-product.destroy": {
            uri: "admin/kategori-product/{kategori_product}",
            methods: ["DELETE"],
            parameters: ["kategori_product"],
        },
        "targets.index": { uri: "admin/targets", methods: ["GET", "HEAD"] },
        "targets.create": {
            uri: "admin/targets/create",
            methods: ["GET", "HEAD"],
        },
        "targets.store": { uri: "admin/targets", methods: ["POST"] },
        "targets.show": {
            uri: "admin/targets/{target}",
            methods: ["GET", "HEAD"],
            parameters: ["target"],
        },
        "targets.edit": {
            uri: "admin/targets/{target}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["target"],
        },
        "targets.update": {
            uri: "admin/targets/{target}",
            methods: ["PUT", "PATCH"],
            parameters: ["target"],
        },
        "targets.destroy": {
            uri: "admin/targets/{target}",
            methods: ["DELETE"],
            parameters: ["target"],
        },
        "product.index": { uri: "admin/product", methods: ["GET", "HEAD"] },
        "product.create": {
            uri: "admin/product/create",
            methods: ["GET", "HEAD"],
        },
        "product.store": { uri: "admin/product", methods: ["POST"] },
        "product.show": {
            uri: "admin/product/{product}",
            methods: ["GET", "HEAD"],
            parameters: ["product"],
        },
        "product.edit": {
            uri: "admin/product/{product}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["product"],
        },
        "product.update": {
            uri: "admin/product/{product}",
            methods: ["PUT", "PATCH"],
            parameters: ["product"],
        },
        "product.destroy": {
            uri: "admin/product/{product}",
            methods: ["DELETE"],
            parameters: ["product"],
        },
        "projects.index": { uri: "admin/projects", methods: ["GET", "HEAD"] },
        "projects.create": {
            uri: "admin/projects/create",
            methods: ["GET", "HEAD"],
        },
        "projects.store": { uri: "admin/projects", methods: ["POST"] },
        "projects.show": {
            uri: "admin/projects/{project}",
            methods: ["GET", "HEAD"],
            parameters: ["project"],
        },
        "projects.edit": {
            uri: "admin/projects/{project}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["project"],
        },
        "projects.update": {
            uri: "admin/projects/{project}",
            methods: ["PUT", "PATCH"],
            parameters: ["project"],
        },
        "projects.destroy": {
            uri: "admin/projects/{project}",
            methods: ["DELETE"],
            parameters: ["project"],
        },
        "storage-dropzone-img": {
            uri: "admin/storage-dropzone-img",
            methods: ["POST"],
        },
        "product.type.create": {
            uri: "admin/product-type/{productId}/create",
            methods: ["GET", "HEAD"],
            parameters: ["productId"],
        },
        "product.type.store": {
            uri: "admin/product-type/store",
            methods: ["POST"],
        },
        "product.type.edit": {
            uri: "admin/product-type/{productId}/{typeId}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["productId", "typeId"],
        },
        "product.type.update": {
            uri: "admin/product-type/{productId}/{typeId}/update",
            methods: ["PUT"],
            parameters: ["productId", "typeId"],
        },
        "product-additional.index": {
            uri: "admin/product-additional",
            methods: ["GET", "HEAD"],
        },
        "product-additional.create": {
            uri: "admin/product-additional/create",
            methods: ["GET", "HEAD"],
        },
        "product-additional.store": {
            uri: "admin/product-additional",
            methods: ["POST"],
        },
        "product-additional.show": {
            uri: "admin/product-additional/{product_additional}",
            methods: ["GET", "HEAD"],
            parameters: ["product_additional"],
        },
        "product-additional.edit": {
            uri: "admin/product-additional/{product_additional}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["product_additional"],
        },
        "product-additional.update": {
            uri: "admin/product-additional/{product_additional}",
            methods: ["PUT", "PATCH"],
            parameters: ["product_additional"],
        },
        "product-additional.destroy": {
            uri: "admin/product-additional/{product_additional}",
            methods: ["DELETE"],
            parameters: ["product_additional"],
        },
        "order-admin.index": {
            uri: "admin/order-admin",
            methods: ["GET", "HEAD"],
        },
        "order-admin.show": {
            uri: "admin/order-admin/{order_admin}",
            methods: ["GET", "HEAD"],
            parameters: ["order_admin"],
        },
        "order-admin.edit": {
            uri: "admin/order-admin/{order_admin}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["order_admin"],
        },
        "order-admin.update": {
            uri: "admin/order-admin/{order_admin}",
            methods: ["PUT", "PATCH"],
            parameters: ["order_admin"],
        },
        "admin.sendEmailAndRedirect": {
            uri: "admin/order-admin/{id}/send-email",
            methods: ["GET", "HEAD"],
            parameters: ["id"],
        },
        "deterimine-pic.index": {
            uri: "admin/deterimine-pic",
            methods: ["GET", "HEAD"],
        },
        "deterimine-pic.show": {
            uri: "admin/deterimine-pic/{deterimine_pic}",
            methods: ["GET", "HEAD"],
            parameters: ["deterimine_pic"],
        },
        "deterimine-pic.update": {
            uri: "admin/deterimine-pic/{deterimine_pic}",
            methods: ["PUT", "PATCH"],
            parameters: ["deterimine_pic"],
        },
        "order-admin.export-quot-pdf": {
            uri: "admin/exportquot-pdf/order-admin/{laporan}",
            methods: ["GET", "HEAD"],
            parameters: ["laporan"],
        },
        "order-admin.export-pdf": {
            uri: "admin/export-pdf/order-admin/{laporan}",
            methods: ["GET", "HEAD"],
            parameters: ["laporan"],
        },
        "order-po": {
            uri: "admin/order-po/{id}",
            methods: ["PUT"],
            parameters: ["id"],
        },
        "storage-dropzone-pdf": {
            uri: "admin/storage-po-dropzone-pdf",
            methods: ["POST"],
        },
        "order-attachment": {
            uri: "admin/order-attachment/{id}",
            methods: ["PUT"],
            parameters: ["id"],
        },
        "storage-attachment-dropzone-pdf": {
            uri: "admin/storage-attachment-dropzone-pdf",
            methods: ["POST"],
        },
        "order-attachment.destroy": {
            uri: "admin/order/{id}/attachment",
            methods: ["DELETE"],
            parameters: ["id"],
        },
        "revision-document.store": {
            uri: "admin/revision-document",
            methods: ["POST"],
        },
        "revision-document.show": {
            uri: "admin/revision-document/{revision_document}",
            methods: ["GET", "HEAD"],
            parameters: ["revision_document"],
        },
        "revision-document.edit": {
            uri: "admin/revision-document/{revision_document}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["revision_document"],
        },
        "revision-document.update": {
            uri: "admin/revision-document/{revision_document}",
            methods: ["PUT", "PATCH"],
            parameters: ["revision_document"],
        },
        "shipping.store": { uri: "admin/shipping", methods: ["POST"] },
        "shipping.show": {
            uri: "admin/shipping/{shipping}",
            methods: ["GET", "HEAD"],
            parameters: ["shipping"],
        },
        "shipping.edit": {
            uri: "admin/shipping/{shipping}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["shipping"],
        },
        "shipping.update": {
            uri: "admin/shipping/{shipping}",
            methods: ["PUT", "PATCH"],
            parameters: ["shipping"],
        },
        "shipping.updateWeight": {
            uri: "admin/shipping/{shipping}",
            methods: ["PUT", "PATCH"],
            parameters: ["shipping"],
        },
        "term-payment.store": { uri: "admin/term-payment", methods: ["POST"] },
        "term-payment.show": {
            uri: "admin/term-payment/{term_payment}",
            methods: ["GET", "HEAD"],
            parameters: ["term_payment"],
        },
        "term-payment.edit": {
            uri: "admin/term-payment/{term_payment}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["term_payment"],
        },
        "term-payment.update": {
            uri: "admin/term-payment/{term_payment}",
            methods: ["PUT", "PATCH"],
            parameters: ["term_payment"],
        },
        "give-discount.update": {
            uri: "admin/give-discount/{id}",
            methods: ["PUT"],
            parameters: ["id"],
        },
        "order-admin.export-excel": {
            uri: "admin/export-excel/order-admin",
            methods: ["GET", "HEAD"],
        },
        "admin.profile.edit": {
            uri: "admin/profile",
            methods: ["GET", "HEAD"],
        },
        "admin.profile.update": { uri: "admin/profile", methods: ["PATCH"] },
        "admin.profile.destroy": { uri: "admin/profile", methods: ["DELETE"] },
        "versiapps.admin": { uri: "admin/version", methods: ["GET", "HEAD"] },
        "pic.dashboard": { uri: "pic/dashboard", methods: ["GET", "HEAD"] },
        "pic.dashboard.getsales": {
            uri: "pic/dashboard/sales",
            methods: ["GET", "HEAD"],
        },
        "pic.dashboard.getrevenuepic": {
            uri: "pic/dashboard/revenuepic",
            methods: ["GET", "HEAD"],
        },
        "picproduct.index": { uri: "pic/product", methods: ["GET", "HEAD"] },
        "picproduct.create": {
            uri: "pic/product/create",
            methods: ["GET", "HEAD"],
        },
        "picproduct.store": { uri: "pic/product", methods: ["POST"] },
        "picproduct.show": {
            uri: "pic/product/{product}",
            methods: ["GET", "HEAD"],
            parameters: ["product"],
        },
        "picproduct.edit": {
            uri: "pic/product/{product}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["product"],
        },
        "picproduct.update": {
            uri: "pic/product/{product}",
            methods: ["PUT", "PATCH"],
            parameters: ["product"],
        },
        "picproduct.destroy": {
            uri: "pic/product/{product}",
            methods: ["DELETE"],
            parameters: ["product"],
        },
        "picproduct.type.edit": {
            uri: "pic/product-type/{productId}/{typeId}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["productId", "typeId"],
        },
        "picproduct.type.update": {
            uri: "pic/product-type/{productId}/{typeId}/update",
            methods: ["PUT"],
            parameters: ["productId", "typeId"],
        },
        "picproduct-additional.index": {
            uri: "pic/product-additional",
            methods: ["GET", "HEAD"],
        },
        "picproduct-additional.create": {
            uri: "pic/product-additional/create",
            methods: ["GET", "HEAD"],
        },
        "picproduct-additional.store": {
            uri: "pic/product-additional",
            methods: ["POST"],
        },
        "picproduct-additional.show": {
            uri: "pic/product-additional/{product_additional}",
            methods: ["GET", "HEAD"],
            parameters: ["product_additional"],
        },
        "picproduct-additional.edit": {
            uri: "pic/product-additional/{product_additional}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["product_additional"],
        },
        "picproduct-additional.update": {
            uri: "pic/product-additional/{product_additional}",
            methods: ["PUT", "PATCH"],
            parameters: ["product_additional"],
        },
        "picproduct-additional.destroy": {
            uri: "pic/product-additional/{product_additional}",
            methods: ["DELETE"],
            parameters: ["product_additional"],
        },
        "order-pic.index": { uri: "pic/order-pic", methods: ["GET", "HEAD"] },
        "order-pic.show": {
            uri: "pic/order-pic/{order_pic}",
            methods: ["GET", "HEAD"],
            parameters: ["order_pic"],
        },
        "order-pic.edit": {
            uri: "pic/order-pic/{order_pic}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["order_pic"],
        },
        "order-pic.update": {
            uri: "pic/order-pic/{order_pic}",
            methods: ["PUT", "PATCH"],
            parameters: ["order_pic"],
        },
        "pic.sendEmailAndRedirect": {
            uri: "pic/order-pic/{id}/send-email",
            methods: ["GET", "HEAD"],
            parameters: ["id"],
        },
        "orders.byDate": {
            uri: "pic/order-pic/by-date/{date}",
            methods: ["GET", "HEAD"],
            parameters: ["date"],
        },
        "note-commercial.store": {
            uri: "pic/note-commercial",
            methods: ["POST"],
        },
        "note-commercial.show": {
            uri: "pic/note-commercial/{note_commercial}",
            methods: ["GET", "HEAD"],
            parameters: ["note_commercial"],
        },
        "note-commercial.edit": {
            uri: "pic/note-commercial/{note_commercial}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["note_commercial"],
        },
        "note-commercial.update": {
            uri: "pic/note-commercial/{note_commercial}",
            methods: ["PUT", "PATCH"],
            parameters: ["note_commercial"],
        },
        "revisions.store": { uri: "pic/revisions", methods: ["POST"] },
        "revisions.show": {
            uri: "pic/revisions/{revision}",
            methods: ["GET", "HEAD"],
            parameters: ["revision"],
        },
        "revisions.edit": {
            uri: "pic/revisions/{revision}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["revision"],
        },
        "revisions.update": {
            uri: "pic/revisions/{revision}",
            methods: ["PUT", "PATCH"],
            parameters: ["revision"],
        },
        "shippings.store": { uri: "pic/shippings", methods: ["POST"] },
        "shippings.show": {
            uri: "pic/shippings/{shipping}",
            methods: ["GET", "HEAD"],
            parameters: ["shipping"],
        },
        "shippings.edit": {
            uri: "pic/shippings/{shipping}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["shipping"],
        },
        "shippings.update": {
            uri: "pic/shippings/{shipping}",
            methods: ["PUT", "PATCH"],
            parameters: ["shipping"],
        },
        "term-payments.store": { uri: "pic/term-payments", methods: ["POST"] },
        "term-payments.show": {
            uri: "pic/term-payments/{term_payment}",
            methods: ["GET", "HEAD"],
            parameters: ["term_payment"],
        },
        "term-payments.edit": {
            uri: "pic/term-payments/{term_payment}/edit",
            methods: ["GET", "HEAD"],
            parameters: ["term_payment"],
        },
        "term-payments.update": {
            uri: "pic/term-payments/{term_payment}",
            methods: ["PUT", "PATCH"],
            parameters: ["term_payment"],
        },
        "give-discounts.update": {
            uri: "pic/give-discounts/{id}",
            methods: ["PUT"],
            parameters: ["id"],
        },
        "orders-po": {
            uri: "pic/orders-po/{id}",
            methods: ["PUT"],
            parameters: ["id"],
        },
        "storage-dropzone-pdfs": {
            uri: "pic/storage-po-dropzone-pdfs",
            methods: ["POST"],
        },
        "orders-attachment": {
            uri: "pic/orders-attachment/{id}",
            methods: ["PUT"],
            parameters: ["id"],
        },
        "storage-attachment-dropzone-pdfs": {
            uri: "pic/storage-attachment-dropzone-pdfs",
            methods: ["POST"],
        },
        "orders-attachment.destroy": {
            uri: "admin/orders/{id}/attachment",
            methods: ["DELETE"],
            parameters: ["id"],
        },
        "pic.cart.delete": {
            uri: "pic/cart/del/{id}",
            methods: ["DELETE"],
            parameters: ["id"],
        },
        "pic.cart.addAdditionalProduct": {
            uri: "pic/cart/add-additional-product",
            methods: ["POST"],
        },
        "pic.cart.updateAdditionalProductPrice": {
            uri: "/cart/update-additional-product/{id}",
            methods: ["PUT"],
        },
        "order-pic.export-quot-pdf": {
            uri: "pic/exportquot-pdf/order-pic/{laporan}",
            methods: ["GET", "HEAD"],
            parameters: ["laporan"],
        },
        "cart.index": { uri: "cart", methods: ["GET", "HEAD"] },
        "cart.destroy": {
            uri: "cart/{cart}",
            methods: ["DELETE"],
            parameters: ["cart"],
        },
        "cart.add": { uri: "cart/add", methods: ["POST"] },
        "cart.delete": {
            uri: "cart/del/{id}",
            methods: ["DELETE"],
            parameters: ["id"],
        },
        "cart.addAdditionalProduct": {
            uri: "cart/add-additional-product",
            methods: ["POST"],
        },
        "cart.updateQuantity": {
            uri: "cart/update-quantity",
            methods: ["POST"],
        },
        "checkout.process": { uri: "checkout", methods: ["POST"] },
        "order.detail": {
            uri: "order/{code}",
            methods: ["GET", "HEAD"],
            parameters: ["code"],
        },
        "myorder.all": { uri: "order", methods: ["GET", "HEAD"] },
        "checkout.thankyou": {
            uri: "checkout/thankyou",
            methods: ["GET", "HEAD"],
        },
        register: { uri: "register", methods: ["GET", "HEAD"] },
        login: { uri: "login", methods: ["GET", "HEAD"] },
        "password.request": {
            uri: "forgot-password",
            methods: ["GET", "HEAD"],
        },
        "password.email": { uri: "forgot-password", methods: ["POST"] },
        "password.reset": {
            uri: "reset-password/{token}",
            methods: ["GET", "HEAD"],
            parameters: ["token"],
        },
        "password.store": { uri: "reset-password", methods: ["POST"] },
        "verification.notice": {
            uri: "verify-email",
            methods: ["GET", "HEAD"],
        },
        "verification.verify": {
            uri: "verify-email/{id}/{hash}",
            methods: ["GET", "HEAD"],
            parameters: ["id", "hash"],
        },
        "verification.send": {
            uri: "email/verification-notification",
            methods: ["POST"],
        },
        "password.confirm": {
            uri: "confirm-password",
            methods: ["GET", "HEAD"],
        },
        "password.update": { uri: "password", methods: ["PUT"] },
        logout: { uri: "logout", methods: ["POST"] },
        "about-us": { uri: "about-us", methods: ["GET", "HEAD"] },
        "contact-us": { uri: "contact-us", methods: ["GET", "HEAD"] },
        home: { uri: "home", methods: ["GET", "HEAD"] },
        "product-overview.index": {
            uri: "product-overview",
            methods: ["GET", "HEAD"],
        },
        "product-overview.detail": {
            uri: "product-overview/{slug}",
            methods: ["GET", "HEAD"],
            parameters: ["slug"],
        },
        "contact-us-send": { uri: "contact-us", methods: ["POST"] },
        "product.industry": {
            uri: "product-industry/{industry}",
            methods: ["GET", "HEAD"],
            parameters: ["industry"],
        },
        "search.global": { uri: "search", methods: ["GET", "HEAD"] },
        translations: { uri: "js/translations.js", methods: ["GET", "HEAD"] },
        send: { uri: "send-email", methods: ["GET", "HEAD"] },
    },
};
if (typeof window !== "undefined" && typeof window.Ziggy !== "undefined") {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };
