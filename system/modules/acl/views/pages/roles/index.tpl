<div class="col-md-8 col-md-offset-2">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="lead"> Administration Roles </span>
        </div>

        <div class="panel-body">
            <p>

                {if isset($roles) && count($roles)}
            <table class="table table-condensed table-responsive table-striped table-hover">

                <tr class="success">
                    <th class="text-center">ID</th>
                    <th>Role</th>
                    <th class="text-center">Permissions</th>
                    <th class="text-center">Action</th>
                </tr>

                {foreach item = rl from= $roles}
                    <tr>
                        <td class="text-center">{$rl.id_role}</td>
                        <td>{$rl.role}</td>
                        <td class="text-center">
                            <a href="{$layoutParams.root}acl/permissions/permissions_role/{$rl.id_role}"
                               style="text-decoration: none"> View </a>
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
                                    <li><a href="{$layoutParams.root}acl/roles/edit/{$rl.id_role}"> Edit </a></li>

                                    <li><a href="{$layoutParams.root}acl/roles/delete/{$rl.id_role}"> Delete </a>
                                    </li>

                                </ul>
                            </div>
                        </td>
                    </tr>
                {/foreach}
  
                <tr class="success">
                    <th class="text-center">ID</th>
                    <th>Role</th>
                    <th class="text-center">Permissions</th>
                    <th class="text-center">Action</th>
                </tr>

            </table>
                
                {else}
                    {"No data exists."}
            {/if}

            <p>
    <span class="form-inline">
        <a href="{$layoutParams.root}acl/roles/new_role" class="btn btn-success"
           style="text-decoration: none"> New Role </a>
        <a href="{$layoutParams.root}acl" class="btn btn-warning"> Go Back </a>
    </span>
            </p>

            </p>
        </div>
    </div>

</div>
