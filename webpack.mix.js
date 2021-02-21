const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')

    .copyDirectory('resources/images', 'public/images')

    //DEPENDENCIAS TEMPLATE
    .styles('resources/plugins/icheck-bootstrap/icheck-bootstrap.min.css', 'public/css/icheck-bootstrap.css')
    .styles('resources/plugins/adminlte/css/adminlte.css', 'public/css/adminlte.css')
    .styles('resources/plugins/overlayScrollbars/css/OverlayScrollbars.min.css', 'public/css/OverlayScrollbars.css')
    .scripts('resources/plugins/jquery/jquery.min.js', 'public/js/jquery.js')
    .scripts('resources/plugins/jquery-ui/jquery-ui.min.js', 'public/js/jquery-ui.js')
    .scripts('resources/plugins/bootstrap/js/bootstrap.bundle.min.js', 'public/js/bootstrap.bundle.js')
    .scripts('resources/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js', 'public/js/overlayScrollbars.js')
    .scripts('resources/plugins/chartjs/Chart.min.js', 'public/js/Chart.js')
    .scripts('resources/plugins/adminlte/js/adminlte.js', 'public/js/adminlte.js')
    .copyDirectory('resources/plugins/fontawesome-free', 'public/fontawesome')
    // END - DEPENDENCIAS TEMPLATE

    // LOGIN
    .styles('resources/css/login.css', 'public/css/login.css')
    // END - LOGIN

    // CUSTOM SCRIPTS PAGES
    .scripts('resources/js/register.js', 'public/js/register.js')
    .scripts('resources/js/commissions-control.js', 'public/js/commissions-control.js')
    .scripts('resources/js/points-table.js', 'public/js/points-table.js')
    // END - CUSTOM SCRIPTS PAGES

    // CSS CUSTOM
    .styles('resources/css/custom.css', 'public/css/custom.css')
    // END - CSS CUSTOM

    // DATATABLES
    .scripts([
        'resources/plugins/datatables/jquery.dataTables.min.js',
        'resources/plugins/datatables/datatables-bs4/js/dataTables.bootstrap4.min.js',
        'resources/plugins/datatables/datatables-responsive/js/dataTables.responsive.min.js',
        'resources/plugins/datatables/datatables-responsive/js/responsive.bootstrap4.min.js',
    ], 'public/js/dataTables.js')
    .styles([
        'resources/plugins/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css',
        'resources/plugins/datatables/datatables-responsive/css/responsive.bootstrap4.min.css',
    ], 'public/css/dataTables.css')
    // FIM DATATABLES

    // DROPIFY
    .scripts('node_modules/dropify/dist/js/dropify.js', 'public/js/dropify.js')
    .styles('node_modules/dropify/dist/css/dropify.css', 'public/css/dropify.css')
    .copyDirectory('node_modules/dropify/dist/fonts', 'public/fonts')
    // END DROPIFY

    // ADD INPUT AREA
    .scripts('node_modules/jquery.add-input-area/dist/jquery.add-input-area.min.js', 'public/js/jquery.add-input-area.js')
    // END - ADD INPUT AREA

    // TOASTR
    .scripts('node_modules/toastr/toastr.js', 'public/js/toastr.js')
    .sass('node_modules/toastr/toastr.scss', 'public/css/toastr.css')
    // END TOASTR

    // FLOAT THEAD
    .scripts('node_modules/floatthead/dist/jquery.floatThead.js', 'public/js/jquery.floatThead.js')
    // FIM FLOAT THEAD

    // MASK
    .scripts('node_modules/jquery-mask-plugin/dist/jquery.mask.js', 'public/js/jquery.mask.js')
    .scripts('resources/js/input-masks.js', 'public/js/input-masks.js')
    // FIM MASK

    // SELECT2
    .scripts([
        'node_modules/select2/dist/js/select2.full.js',
        'node_modules/select2/dist/js/i18n/pt-BR.js'
    ], 'public/js/select2.js')
    .styles([
        'node_modules/select2/dist/css/select2.css',
        'node_modules/select2-theme-bootstrap4/dist/select2-bootstrap.css'
    ], 'public/css/select2.css')
    // FIM SELECT2

    // Summernote
    .scripts('node_modules/summernote/dist/summernote-bs4.js', 'public/js/summernote-bs4.js')
    .scripts('node_modules/summernote/lang/summernote-pt-BR.js', 'public/js/summernote-pt-BR.js')
    .scripts('node_modules/summernote/dist/summernote-bs4.css', 'public/css/summernote/summernote-bs4.css')
    .copyDirectory('node_modules/summernote/dist/font', 'public/css/summernote/font')
    // FIM Summernote

    // printThis
    .scripts('node_modules/print-this/printThis.js', 'public/js/printThis.js')
    // FIM printThis

    .options({
        processCssUrls: false
    })
;
