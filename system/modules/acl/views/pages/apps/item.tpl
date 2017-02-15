<div class="col-md-8 col-md-offset-2">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="lead"> apps </span>
        </div>

        <div class="panel-body">
            <p>

                {if isset($apps) && count($apps)}

            <table class="table table-condensed table-responsive table-striped table-hover">

                <tr class="success">
                    <th class="text-center">Id</th>
                    <th> Name</th>
                    <th> Url</th>
                    <th class="text-center"> Icon</th>
					<th class="text-center"> Status</th>
                    <th class="text-center"> Action</th>
                </tr>

                {foreach from= $apps item = app}
                    <tr>
                        <td class="text-center">
                            {$app.app_id}
                        </td>
                        <td>{$app.app_name}</td>
                        <td>{$app.app_url}</td>
                        <td class="text-center"><span class="fa fa-{$app.app_icon}"></span></td>
						<td class="text-center">{$app.app_status}</td>

                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary dropdown-toggle btn-xs"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                    Action
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="{$layoutParams.root}acl/apps/edit/{$app.app_id}" class=" small">Edit</a>
                                    </li>
                                    <li><a href="{$layoutParams.root}acl/apps/delete/{$app.app_id}"
                                           class=" small">Delete</a></li>

                                </ul>
                            </div>
                        </td>
                    </tr>
                {/foreach}

                <tr class="success">
                    <th class="text-center">Id</th>
                    <th> Name</th>
                    <th> Url</th>
                    <th class="text-center"> Icon</th>
					<th class="text-center"> Status</th>
                    <th class="text-center"> Action</th>
                </tr>

            </table>

            {else}

            {'No item exists.'}

            {/if}

            <p>
                <span class="form-inline">
                    <a href="{$layoutParams.root}acl/apps/newItem" class="btn btn-success"> Add new app </a>
                    <a href="{$layoutParams.root}acl/apps" class="btn btn-warning"> Go Back </a>
                </span>
            </p>
            </p>
        </div>
    </div>

</div>
