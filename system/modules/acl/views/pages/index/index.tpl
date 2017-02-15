<div class="col-md-8 col-md-offset-2">

    <div class="panel panel-primary">
        <div class="panel-heading">
            {if $acl->permision('edit_content')}
            <a href="{$layoutParams.root}acl/index/item">
                <button type="button" class="close icon-white" aria-hidden="true">
                    <span class="fa fa-edit"></span>
                </button>
            </a>
            {/if}
            <span class="lead"> Control Panel </span>
            <span></span>
        </div>

        <div class="panel-body">
            <p>

            {if isset($acl_menu) && count($acl_menu)}
                {foreach from = $acl_menu item = am}

                    <div class="col-md-4 col-md-offset-1">
                        <span type="button" class="btn btn-lg" data-toggle="tooltip" data-placement="bottom" title="{$am.am_title}">
                            <a href="{$layoutParams.root}acl/{$am.am_url}">
                                <span class="fa fa-{$am.am_icon}">
                                    <span class="text-left">
                                        {$am.am_name}
                                    </span>
                                </span>
                            </a>
                        </span>
                    </div>

                {/foreach}

            {else}

            {'No menu exists.'}

            {/if}

            </p>
        </div>
    </div>
</div>
