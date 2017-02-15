<div class="col-md-8 col-md-offset-2">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="lead"> Edit item {if isset($ai.am_name)} : {$ai.am_name}{/if} </span>
        </div>

        <div class="panel-body">
            <p>

                {if isset($acl_item) && count($acl_item)}

            <form name="form1" method="post" action="" role="form">
                <input type="hidden" name="add" value="1"/>

                {foreach from= $acl_item item = ai}
                    <span class="input-group">
                        <span class="input-group-addon">
                            Name:
                        </span>
                        <input type="text" name="am_name" class="form-control"
                               placeholder="{if isset($ai.am_name)}{$ai.am_name}{/if}"
                               value="{if isset($data.am_name)}{$data.am_name}{/if}"
                               maxlength="60"/>
                    </span>
                    <br/>
                    <span class="input-group">
                        <span class="input-group-addon">
                            Title:
                        </span>
                        <input type="text" name="am_title" class="form-control"
                               placeholder="{if isset($ai.am_title)}{$ai.am_title}{/if}"
                               value="{if isset($data.am_title)}{$data.am_title}{/if}"
                               maxlength="40"/>
                    </span>
                    <br/>
                    <span class="input-group">
                        <span class="input-group-addon">
                            Url:
                        </span>
                        <input type="text" name="am_url" class="form-control"
                               placeholder="{if isset($ai.am_url)}{$ai.am_url}{/if}"
                               value="{if isset($data.am_url)}{$data.am_url}{/if}"
                               maxlength="60"/>
                    </span>
                    <br/>
                    <span class="input-group">
                        <span class="input-group-addon">
                            Icon:
                        </span>
                        <input type="text" name="am_icon" class="form-control"
                               placeholder="{if isset($ai.am_icon)}{$ai.am_icon}{/if}"
                               value="{if isset($data.am_icon)}{$data.am_icon}{/if}"
                               maxlength="40"/>
                    </span>
                    <br/>
                    <input type="submit" class="btn btn-primary" value="Update"/>
                    <a href="{$layoutParams.root}acl/index/item" class="btn btn-warning"> Go Back </a>
                {/foreach}

            </form>

            {/if}

            </p>
        </div>
    </div>

</div>
