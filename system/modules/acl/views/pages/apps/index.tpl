<div class="col-md-8 col-md-offset-2">

    <div class="panel panel-primary">
        <div class="panel-heading">
            {if $acl->permision('edit_content')}
                <a href="{$layoutParams.root}acl/apps/item">
                    <button type="button" class="close icon-white" aria-hidden="true">
                        <span class="fa fa-edit"></span>
                    </button>
                </a>
            {/if}
            <span class="lead"> Apps </span>
            <span></span>
        </div>

        <div class="panel-body">
            <p>

                {if isset($apps) && count($apps)}
                {foreach from = $apps item = app}
            <div class="col-md-6 navbar">
            <span type="button" class="btn btn-lg" data-toggle="tooltip" data-placement="bottom"
                  title="{$app.app_name}">
                <a href="{$layoutParams.root}{$app.app_url}">
                    <i class="fa fa-{$app.app_icon}" aria-hidden="true">
                        <span class="text-left">
                            {ucfirst(strtolower($app.app_name))}
                        </span>
                    </i>
                </a>
            </span>
            </div>
            {/foreach}

            {else}

            {'No apps exists.'}

            {/if}

            </p>
        </div>
    </div>
</div>
