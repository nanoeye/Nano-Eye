<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="lead">
                Edit Modules : {if isset($data.md_name)} {$data.md_name} {/if} </span>
        </div>

        <div class="panel-body">
            <p>

            <div class="col-md-8 col-md-offset-2">
                <form name="form1" method="post" action="" role="form">
                    <input type="hidden" name="add" value="1"/>

        <span class="input-group">
            <span class="input-group-addon">
                Name:
                </span>
            <input type="text" name="md_name" class="form-control" placeholder="New module's name"
                   value="{if isset($data.md_name)}{$data.md_name}{/if}" required="1"/>
            </span>

                    <br/>
            <span class="input-group">
            <span class="input-group-addon">
                Status:
                </span>
                <select name = "md_status" class="form-control">
                    <option name=""> Select one </option>
                    <option name="enable" {if isset($data) && ($data.md_status == 'enable')} selected="selected" {/if}> Enable </option>
                    <option name="disable" {if isset($data) && ($data.md_status == 'disable')} selected="selected" {/if}> Disable </option>
                </select>
            </span>

                    <br/>

                    <input type="submit" class="btn btn-primary" value="Update"/>
                    <a href="{$layoutParams.root}acl/modules" class="btn btn-warning"> Go Back </a>

                </form>
            </div>
            </p>
        </div>
    </div>

</div>
