<div class="col-md-8 col-md-offset-2">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="lead"> Administration Permissions  </span>
        </div>

        <div class="panel-body">
            <p>
            <div>
                <div class="pull-right">
                    <a href="{$layoutParams.root}acl/permissions/new_permission" class="btn btn-success"
                       style="text-decoration: none">
                        <i class="fa fa-plus-circle"></i> New permission </a>
                </div>
                <div class="pull-left">
                    <a href="{$layoutParams.root}acl" class="btn btn-warning">
                        <i class="fa fa-backward"></i>
                        Go Back
                    </a>
                </div>
            </div>
            </p>
            <p>
            {if isset($permissions) && count($permissions)}
            <table class="table table-condensed table-responsive table-striped table-hover text-center">

                <tr class="success">
                    <th> Id</th>
                    <th> Permission</th>
                    <th class="text-center"> Key</th>
                    <th class="text-center"><b> Action </b></th>

                </tr>

                {foreach item = pr from= $permissions}
                    <tr>
                        <td align="left">{$pr.id}</td>
                        <td align="left">{$pr.number}</td>
                        <td align="center">{$pr.key}</td>

                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                    Action
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="{$layoutParams.root}acl/permissions/edit/{$pr.id}">Edit</a></li>
                                    <li><a href="{$layoutParams.root}acl/permissions/delete/{$pr.id}">Delete</a></li>

                                </ul>
                            </div>
                        </td>

                    </tr>
                {/foreach}
 
                <tr class="success">
                    <th> Id</th>
                    <th> Permission</th>
                    <th class="text-center"> Key</th>
                    <th class="text-center"><b> Action </b></th>
                </tr>

            </table>
                
                {else}
                    {"No data exists."}
            {/if}

            </p>
        </div>
    </div>

</div>
