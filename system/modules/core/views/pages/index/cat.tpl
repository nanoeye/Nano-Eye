
{if isset($catagories) && count($catagories)}

    {foreach item = c  from =$catagories}

        <div class="col-md-4 bg-success"">
        <span type="button" class="btn btn-lg" data-toggle="tooltip" data-placement="bottom"
              title="{$c.name}">
        <a href="{$layoutParams.root}{$c.url}">
            <span class="fa fa-{$c.icon}">
                <span class="text-left">
                    {$c.title}
                </span>
            </span>
        </a>
    </span>
        </div>

    {/foreach}

{/if}
