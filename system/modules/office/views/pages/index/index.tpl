{if $acl->permision('edit_JobCat')}
    <a href="{$layoutParams.root}office/index/item">
        <button type="button" class="close icon-white" aria-hidden="true">
            <span class="fa fa-edit"></span>
        </button>
    </a>
{/if}

<div>
    <div class="lead">
        Job item
        <hr/>
    </div>
    {if isset($jobs_cats) && count($jobs_cats)}
        {foreach from = $jobs_cats item = jc}
            <div class="col-md-2 ">
            <span type="button" class="btn btn-lg" data-toggle="tooltip" data-placement="bottom"
                  title="{$jc.oj_title}">
                <a href="{$layoutParams.root}office/contents/dir/{$jc.oj_id}">
                    <span class="fa fa-{$jc.oj_icon}">
                        <span class="text-left">
                            {$jc.oj_name}
                        </span>
                    </span>
                </a>
            </span>
            </div>
        {/foreach}

    {else}

        {'No job catagory exists.'}

    {/if}
</div>