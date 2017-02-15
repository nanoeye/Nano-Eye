<div class="col-md-8 col-md-offset-2">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="lead"> Apps </span>
        </div>

        <div class="panel-body">
            <p>

                {if isset($apps) && count($apps)}

            <table class="table table-condensed table-responsive table-striped table-hover">

                <tr class="success">
                    <th class="text-center">ID</th>
                    <th>Name</th>
                    <th class="text-center">Icon</th>
                    <th class="text-center">Url</th>
                    <th class="text-center">Action</th>
                </tr>

                {foreach item = app from= $apps}
                    <tr>
                        <td class="text-center">{$app.app_id}</td>
                        <td>{ucfirst(strtolower($app.app_name))}</td>
                        <td class="text-center">
                            {$app.app_icon}
                        </td>
                        <td class="text-center">
                            {$app.app_url}
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                    Action
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="{$layoutParams.root}acl/modules/e/{$app.app_id}"> Edit </a></li>

                                    <li><a href="{$layoutParams.root}acl/modules/d/{$app.app_id}"> Delete </a>
                                    </li>

                                </ul>
                            </div>
                        </td>
                    </tr>
                {/foreach}

                <tr class="success">
                    <th class="text-center">ID</th>
                    <th>Name</th>
                    <th class="text-center">Icon</th>
                    <th class="text-center">Url</th>
                    <th class="text-center">Action</th>
                </tr>

            </table>

            {else}
            {"No data exists."}
            {/if}

            <p>
                <span class="form-inline">
                    <a href="{$layoutParams.root}acl/modules/newApp" class="btn btn-success"
                       style="text-decoration: none"> Add new apps </a>
                    <a href="{$layoutParams.root}acl/" class="btn btn-warning"> Go Back </a>
                </span>
            </p>

            </p>
        </div>
    </div>
</div>
