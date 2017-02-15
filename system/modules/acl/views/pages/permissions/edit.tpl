<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="lead">
                Edit Permission : {if isset($data.permision)} {$data.permision} {/if} </span>
        </div>

        <div class="panel-body">
            <p>

            <div class="col-md-8 col-md-offset-2">
                <form name="form1" method="post" action="" role="form">
                    <input type="hidden" name="add" value="1"/>

        <span class="input-group">
            <span class="input-group-addon">
                Permission Name:
                </span>
            <input type="text" name="permision" class="form-control" placeholder="New permission name"
                   value="{if isset($data.permision)}{$data.permision}{/if}" required="1"/>
            </span>

                    <br/>
            <span class="input-group">
            <span class="input-group-addon">
                Key:
                </span>
            <input type="text" name="key" class="form-control" placeholder="New key"
                   value="{if isset($data.key)}{$data.key}{/if}" required="1"/>
            </span>

                    <br/>

                    <input type="submit" class="btn btn-primary" value="Update"/>
                    <a href="{$layoutParams.root}acl/permissions" class="btn btn-warning"> Go Back </a>

                </form>
            </div>
            </p>
        </div>
    </div>

</div>
