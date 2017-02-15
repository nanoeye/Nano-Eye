<div class="col-md-8 col-md-offset-2">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="lead"> Users </span>
        </div>

        <div class="panel-body">
            <p>

                {if isset($users) && count($users)}
            <table class="table table-condensed table-responsive table-striped table-hover text-center">

                <tr class="success">
                    <td>
                        Id
                    </td>
                    <td>
                        User
                    </td>
                    <td>
                        Role
                    </td>
                    <td>
                        Action
                    </td>
                </tr>
                {foreach from = $users item = us}
                    <tr>
                        <td>
                            {$us.id}
                        </td>
                        <td>
                            {$us.f_name} {$us.l_name}
                        </td>
                        <td>
                            {$us.role}
                        </td>
                        <td>
                            <a href="{$layoutParams.root}user/index/permissions/{$us.id}"
                               style="text-decoration: none;">
                                Permissions
                            </a>
                        </td>
                    </tr>
                {/foreach}

                <tr class="success">
                    <td>
                        Id
                    </td>
                    <td>
                        User
                    </td>
                    <td>
                        Role
                    </td>
                    <td>
                        Action
                    </td>
                </tr>

            </table>
            {/if}
            </p>
        </div>
    </div>

</div>
