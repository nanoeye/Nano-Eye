<!DOCTYPE html>
<html lang="en">
<head>
    <title> {$title|default: "Welcome to The ALAN"} || {$layoutParams.configs.app_name} </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {if isset($layoutParams.favicon)}
        <link href="{$layoutParams.favicon}" rel="icon">
    {else}
        <link href="{$layoutParams.logo_dir}favicon.ico" rel="icon">
    {/if}

    <!-- StyleSheets -->
    <link href="{$layoutParams.root_css}main.css" rel="stylesheet" type="text/css">
    <link href="{$layoutParams.root_css}bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="{$layoutParams.root_css}font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="{$layoutParams.root_css}jquery-ui.css" rel="stylesheet" type="text/css">

    <!-- Javascripts -->
    <script src="{$layoutParams.root_js}main.js" type="text/javascript"></script>
    <script src="{$layoutParams.root_js}jquery-ui.js" type="text/javascript"></script>
    <script src="{$layoutParams.root}public/js/plugin/jquery.validate.js" type="text/javascript"></script>
    <script src="{$layoutParams.root}public/js/jquery.min.js" type="text/javascript"></script>

    {if isset($layoutParams.js) && count($layoutParams.js)}
        {foreach item = js from = $layoutParams.js}
            <script src="{$js}" type="text/javascript"></script>
        {/foreach}
    {/if}

</head>

<body background="{$layoutParams.root_img}background3.jpg">

{if isset($widgets.top)}
    {foreach from = $widgets.top item = tp}
        {$tp}
    {/foreach}

{/if}

<div class="container">

    {*<div class="col-md-2" role="complementary">
        <nav class="bs-docs-sidebar hidden-print hidden-sm hidden-xs">
            <ul class="nav navbar sidebar-left affixed-element-top js-affixed-element-top">
                &nbsp; *}{* Left side widgetbar*}{*
            </ul>
        </nav>
    </div>*}


   {* <div class="col-md-12">*}
        <noscript>
            <p>
                Javascript running here.
            </p>
        </noscript>

        {if isset($error)}
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                {$error}

            </div>
        {/if}
        {if isset($success)}
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                {$success}

            </div>
        {/if}

        <div class="text-justify js-content">

            {include file = $content}
        </div>

   {* </div>*}

{*    <div class="col-md-3" role="complementary">
        <nav class="bs-docs-sidebar hidden-print hidden-sm hidden-xs">
            <ul class="nav navbar sidebar-right affixed-element-top js-affixed-element-top">

                {if isset($widgets.right)}
                    {foreach from = $widgets.right item = ri}
                        {$ri}
                    {/foreach}

                {/if}

            </ul>
        </nav>
    </div>*}
</div>

<!--start of footer navbar-->
<div class="nav navbar-default navbar-fixed-bottom" align="center">
    Copyright &copy; 2014-{date("Y")} {$layoutParams.configs.app_company}
</div> <!--end of footer navbar-->


<script src="{$layoutParams.root_js}bootstrap.min.js"></script>
<script type="text/javascript"> var _root_ = '{$layoutParams.root}'; </script>

<script type="text/javascript">

    $(function () {
        $('.js-affixed-element-top').affix({
            offset: {
                top: $('.js-page-header').outerHeight(false) - 0
            }
        })

                .on('affix.bs.affix', function (e) {
                    $(e.target).width(e.target.offsetWidth)
                })
    });
</script>

{if isset($layoutParams.jsPlugin) && count($layoutParams.jsPlugin)}
    {foreach item = jsplg from = $layoutParams.jsPlugin}
        <script src="{$jsplg}" type="text/javascript"></script>
    {/foreach}
{/if}

{if isset($layoutParams.js) && count($layoutParams.js)}
    {foreach item = js from = $layoutParams.js}
        <script src="{$js}" type="text/javascript"></script>
    {/foreach}
{/if}

</body>
</html>