<div class="col-md-8 col-md-offset-2">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="lead"> Edit item {if isset($ap.app_name)} : {$ap.app_name}{/if} </span>
        </div>

        <div class="panel-body">
            <p>

                {if isset($app) && count($app)}

            <form name="form1" method="post" action="" role="form">
                <input type="hidden" name="add" value="1"/>

                {foreach from= $app item = ap}
                    <span class="input-group">
                        <span class="input-group-addon">
                            Select installed module:
                        </span>

						<select class="form-control" name="module">
						<option value=""> Select One</option>
                            {foreach from = $modules item = m}
                                <option value="{$m.md_name}" {if isset($data) && ($data.module == $m.md_name) || isset($app)
                                && ($ap.app_url == $m.md_name)} selected="selected" {/if}> {$m.md_name} </option>
                            {/foreach}
						</select>
                    </span>
                    <br/>
{*                    <span class="input-group">
                        <span class="input-group-addon">
                            Url:
                        </span>
                        <input type="text" name="am_url" class="form-control"
                               placeholder="{if isset($ai.am_url)}{$ai.am_url}{/if}"
                               value="{if isset($data.am_url)}{$data.am_url}{/if}"
                               maxlength="60"/>
                    </span>
                    <br/>*}
                    <span class="input-group">
                        <span class="input-group-addon">
                            Icon:
                        </span>
                        <input type="text" name="app_icon" class="form-control"
                               placeholder="{if isset($ap.app_icon)}{$ap.app_icon}{/if}"
                               value="{if isset($data.appm_icon)}{$data.app_icon}{/if}"
                               maxlength="40"/>
                    </span>
                    <br/>
                    <span class="input-group">
                        <span class="input-group-addon">
                            status:
                        </span>
                        <select class="form-control" name="app_status">
                            <option value=""> Select One</option>
                            <option value="active" {if isset($data) && ($data.app_status == 'active') || isset($app)
                            && ($ap.app_status == 'active')} selected="selected" {/if}> Active </option>

                            <option value="deactive" {if isset($data) && ($data.app_status == 'deactive') || isset($app)
                            && ($ap.app_status == 'deactive')} selected="selected" {/if}> Deactive </option>
						</select>
                    </span>
                    <br/>

                    <input type="submit" class="btn btn-primary" value="Update"/>
                    <a href="{$layoutParams.root}acl/apps/item" class="btn btn-warning"> Go Back </a>
                {/foreach}

            </form>

            {/if}

            </p>
        </div>
    </div>

</div>