<!-- jQuery | definido en settings.php -->
<?php echo get_jquery(); ?>

<!-- CSS Framework scripts | Por defecto Bootstrap 5 | definido en settings.php -->
<?php echo get_css_framework_scripts(); ?>

<!-- Axios | definido en settings.php -->
<?php echo get_axios(); ?>

<!-- Toastr js -->
<?php echo get_toastr(); ?>

<!-- waitme js -->
<?php echo get_waitMe(); ?>

<!-- Lightbox js -->
<?php echo get_lightbox(); ?>

<!-- Objeto Bee Javascript registrado -->
<?php echo load_bee_obj(); ?>

<!-- Scripts registrados manualmente -->
<?php echo load_scripts(); ?>

<!-- Mercado Pago -->
<script src="https://sdk.mercadopago.com/js/v2"></script>

<!-- Scripts personalizados Bee Framework -->
<script src="<?php echo JS.'main.js?v='.get_version(); ?>"></script>