<div class="lead">
    Apps
    <hr/>
</div>
{if isset($apps) && count($apps)}
    {foreach from = $apps item = app}
        <div class="col-md-6 navbar">
            <span type="button" class="btn btn-lg" data-toggle="tooltip" data-placement="bottom"
                  title="{$app.app_name}">
                <a href="{$layoutParams.root}{$app.app_url}">
                    <span class="fa fa-{$app.app_icon}">
                        <span class="text-left">
                            {ucfirst(strtolower($app.app_name))}
                        </span>
                    </span>
                </a>
            </span>
        </div>
    {/foreach}

{else}

    {'No apps exists.'}

{/if}
