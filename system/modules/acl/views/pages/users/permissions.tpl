<div class="col-md-8 col-md-offset-2">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="lead"> User's Permissions </span>
        </div>

        <div class="panel-body">
            <p>

            <h4> User: {$info.f_name} {$info.l_name} (Role: {$info.role} ) </h4>

            <form name="form1" method="post" action="" role="form">
                <input type="hidden" value="1" name="val"/>

                {if isset ($permisions) && count($permisions)}
                    <table class="table table-condensed table-bordered table-responsive table-striped table-hover text-center">

                        <tr class="success">

                            <td> Id</td>
                            <td> Permissions</td>
                            <td> Action</td>

                        </tr>

                        {foreach from = $permisions item = pr}

                            {if $role.$pr.value == 1}
                                {assign var = 'v' value = 'Enable'}
                            {else}
                                {assign var = 'v' value = 'Reject'}
                            {/if}
                            <tr>
                                <td> {$user.$pr.id}</td>
                                <td> {$user.$pr.permision}</td>
                                <td>

                                    <select name="perm_{$user.$pr.id}" class="form-control-static">
                                        <option value="x" {if $user.$pr.inherit} selected="selected" {/if}> inherit({$v}
                                            )
                                        </option>
                                        <option value="1" {if ($user.$pr.value == 1 && $user.$pr.inherit == "")} selected="selected" {/if}>
                                            Enable
                                        </option>
                                        <option value="" {if ($user.$pr.value == "" && $user.$pr.inherit == "")} selected="selected" {/if}>
                                            Reject
                                        </option>
                                    </select>

                                </td>
                            </tr>
                        {/foreach}

                        <tr class="success">

                            <td> Id</td>
                            <td> Permissions</td>
                            <td> Action</td>

                        </tr>
                    </table>
                    <p>
                        <input type="submit" value="Save" class="btn btn-primary"/>
                        <a href="{$layoutParams.root}acl/users" class="btn btn-warning"> Go Back </a>
                    </p>
                {/if}
            </form>
            </p>
        </div>
    </div>

</div>
