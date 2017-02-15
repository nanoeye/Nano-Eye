<div class="col-md-8 col-md-offset-2">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="lead"> Permissions </span>
        </div>

        <div class="panel-body">
            <p>

            <span class="lead"> Role: <b> {$role.role} </b></span>

            <form name="form1" method="post" action="">
                <input type="hidden" name="val" value="1"/>

                {if isset($permissions) && count($permissions)}
                    <table class="table table-condensed table-responsive table-striped table-hover text-center">

                        <tr class="success">
                            <th> Permission</th>
                            <td align="center"><b> Enable </b></td>
                            <td align="center"><b> Reject </b></td>
                            <td align="center"><b> Ignore </b></td>
                        </tr>

                        {foreach item = pr from= $permissions}
                            <tr>

                                <td align="left">{$pr.number}</td>

                                <td>
                                    <input type="radio" name="perm_{$pr.id}"
                                           value="1" {if $pr.value == 1} checked="checked" {/if} />
                                </td>

                                <td>
                                    <input type="radio" name="perm_{$pr.id}"
                                           value="" {if $pr.value == ''} checked="checked" {/if} />
                                </td>

                                <td>
                                    <input type="radio" name="perm_{$pr.id}"
                                           value="x" {if $pr.value === 'x'} checked="checked" {/if} />
                                </td>

                            </tr>
                        {/foreach}

                        <tr class="success">
                            <th><b> Permission </b></th>
                            <td><b> Enable </b></td>
                            <td><b> Reject </b></td>
                            <td><b> Ignore </b></td>
                        </tr>

                    </table>
                {/if}

                <p>
                    <!--input type="reset" value="Reset" class="btn btn-danger"/-->
                    <input type="submit" value="Save" class="btn btn-primary"/>
                    <a href="{$layoutParams.root}acl/roles" class="btn btn-warning"> Go Back </a>
                    <!--button> <a href="{$layoutParams.root}users/acl/roles"> &times; Cancel</a> </button-->
                </p>
            </form>

            </p>
        </div>
    </div>

</div>
