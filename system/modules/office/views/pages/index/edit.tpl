<div class="col-md-8 col-md-offset-2">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="lead"> Edit item {if isset($jc.oj_name)} : {$jc.oj_name}{/if} </span>
        </div>

        <div class="panel-body">
            <p>

                {if isset($jobs_cat) && count($jobs_cat)}

            <form name="form1" method="post" action="" role="form">
                <input type="hidden" name="add" value="1"/>

                {foreach from= $jobs_cat item = jc}
                    <span class="input-group">
                        <span class="input-group-addon">
                            Name:
                        </span>
                        <input type="text" name="oj_name" class="form-control"
                               placeholder="{if isset($jc.oj_name)}{$jc.oj_name}{/if}"
                               value="{if isset($data.oj_name)}{$data.oj_name}{/if}"
                               maxlength="60"/>
                    </span>
                    <br/>
                    <span class="input-group">
                        <span class="input-group-addon">
                            Title:
                        </span>
                        <input type="text" name="oj_title" class="form-control"
                               placeholder="{if isset($jc.oj_title)}{$jc.oj_title}{/if}"
                               value="{if isset($data.oj_title)}{$data.oj_title}{/if}"
                               maxlength="40"/>
                    </span>
                    <br/>
                    <span class="input-group">
                        <span class="input-group-addon">
                            Url:
                        </span>
                        <input type="text" name="oj_url" class="form-control"
                               placeholder="{if isset($jc.oj_url)}{$jc.oj_url}{/if}"
                               value="{if isset($data.oj_url)}{$data.oj_url}{/if}"
                               maxlength="60"/>
                    </span>
                    <br/>
                    <span class="input-group">
                        <span class="input-group-addon">
                            Icon:
                        </span>
                        <input type="text" name="oj_icon" class="form-control"
                               placeholder="{if isset($jc.oj_icon)}{$jc.oj_icon}{/if}"
                               value="{if isset($data.oj_icon)}{$data.oj_icon}{/if}"
                               maxlength="40"/>
                    </span>
                    <br/>
                    <input type="submit" class="btn btn-primary" value="Update"/>
                    <a href="{$layoutParams.root}office/index/item" class="btn btn-warning"> Go Back </a>
                {/foreach}

            </form>

            {/if}

            </p>
        </div>
    </div>

</div>
