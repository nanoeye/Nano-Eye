<div class="col-md-8 col-md-offset-2">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="lead"> Add new app </span>
        </div>

        <div class="panel-body">
            <p>

            <form name="form1" method="post" action="" role="form">
                <input type="hidden" name="add" value="1"/>

                <span class="input-group">
                        <span class="input-group-addon">
                            Select installed module:
                        </span>
						
						<select class="form-control" name="module">
						<option value=""> Select One</option>
                            {foreach from = $modules item = m}
                                <option value="{$m.md_name}"> {$m.md_name} </option>
                            {/foreach}
						</select>
                    </span>
                <br/>

                <span class="input-group">
                        <span class="input-group-addon">
                            Icon:
                        </span>
                        <input type="text" name="app_icon" class="form-control"
                               placeholder="Please write item's icon."
                               value="{if isset($data.am_icon)}{$data.am_icon}{/if}"
                               required="1" maxlength="40"/>
                    </span>
                <br/>
                <span class="input-group">
                        <span class="input-group-addon">
                            status:
                        </span>
                        <select class="form-control" name="app_status">
                            <option value=""> Select One</option>
                            <option value="active"> Active </option>
                            <option value="deactive"> Deactive </option>
						</select>
                    </span>
                <br/>
                <input type="submit" class="btn btn-primary" value="add"/>
                <a href="{$layoutParams.root}acl/apps/item" class="btn btn-warning"> Go Back </a>

            </form>

            </p>
        </div>
    </div>

</div>
