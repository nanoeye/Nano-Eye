<div class="col-md-8 col-md-offset-2">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="lead"> Add new App </span>
        </div>

        <div class="panel-body">
            <p>
            <div class="col-md-7 col-md-offset-2">
                <form name="form1" method="post" action="" role="form">
                    <input type="hidden" name="add" value="1"/>

                    <span class="input-group">
                        <span class="input-group-addon">
                            Name:
                        </span>

                        {if isset($modules) && count($modules)}

                            <span id="controlgroup1">
                                    <select name="app_name" class="form-control">
                                        <option value=""> Select name </option>

                                        {foreach from = $modules item = md}

                                            <option value="{$md.md_name}" {if isset($data) && ($data.app_name == $md.md_name)} selected="selected" {/if}> {$md.md_name} </option>

                                        {/foreach}

                                    </select>
                                </span>

                        {/if}

                    </span>

                    <br/>

                    <span class="input-group">
                        <span class="input-group-addon">
                            Icon:
                        </span>
                        <input type="text" name="app_icon" class="form-control" placeholder="New app icon"
                               value="{if isset($data.app_icon)}{$data.app_icon}{/if}" required="1"/>
                    </span>

                    <br/>

                    <span class="input-group">
                        <span class="input-group-addon">
                            Url:
                        </span>
                        <input type="text" name="app_url" class="form-control" placeholder="New app url"
                               value="{if isset($data.app_url)}{$data.app_url}{/if}" required="1"/>
                    </span>

                    <br/>

                    <input type="submit" class="btn btn-primary" value="Add"/>
                    <a href="{$layoutParams.root}acl/modules/apps" class="btn btn-warning"> Go Back </a>

                </form>
            </div>
            </p>
        </div>
    </div>

</div>
