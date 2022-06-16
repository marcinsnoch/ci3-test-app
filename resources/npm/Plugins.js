const Plugins = [
    // AdminLTE
    {
        from: "node_modules/admin-lte/dist",
        to: "public/plugins/admin-lte"
    },
    // Bootstrap
    {
        from: "node_modules/bootstrap/dist",
        to: "public/plugins/bootstrap"
    },
    // Bootstrap-table
    {
        from: "node_modules/bootstrap-table/dist",
        to: "public/plugins/bootstrap-table"
    },
    // Font Awesome
    {
        from: "node_modules/@fortawesome/fontawesome-free/css",
        to: "public/plugins/fontawesome-free/css"
    },
    {
        from: "node_modules/@fortawesome/fontawesome-free/webfonts",
        to: "public/plugins/fontawesome-free/webfonts"
    },
    // iCheck
    {
        from: "node_modules/icheck-bootstrap",
        to: "public/plugins/icheck-bootstrap"
    },
    // jQuery
    {
        from: "node_modules/jquery/dist",
        to: "public/plugins/jquery"
    },
    // jQuery validation
    {
        from: "node_modules/jquery-validation/dist",
        to: "public/plugins/jquery-validation"
    },
    // Toastr
    {
        from: "node_modules/toastr/build",
        to: "public/plugins/toastr"
    }
];

module.exports = Plugins;
