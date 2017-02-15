<div class="col-md-8 col-md-offset-2">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="lead"> Modules </span>
        </div>

        <div class="panel-body">
            <p>

                {if isset($modules) && count($modules)}

                <table class="table table-condensed table-responsive table-striped table-hover">

                    <tr class="success">
                        <th class="text-center">ID</th>
                        <th>Modules</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>

                    {foreach item = md from= $modules}
                        <tr>
                            <td class="text-center">{$md.md_id}</td>
                            <td>{$md.md_name}</td>
                            <td class="text-center">
                                {$md.md_status}
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
                                        <li><a href="{$layoutParams.root}acl/modules/edit/{$md.md_id}"> Edit </a></li>

                                        <li><a href="{$layoutParams.root}acl/modules/delete/{$md.md_id}"> Delete </a>
                                        </li>

                                    </ul>
                                </div>
                            </td>
                        </tr>
                    {/foreach}

                    <tr class="success">
                        <th class="text-center">ID</th>
                        <th>Modules</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>

                </table>

            {else}
                {"No data exists."}
            {/if}

            <p>
                <span class="form-inline">
                    <a href="{$layoutParams.root}acl/modules/newModule" class="btn btn-success"
                       style="text-decoration: none"> Add new Modules </a>
                    <a href="{$layoutParams.root}acl" class="btn btn-warning"> Go Back </a>
                </span>
            </p>

            </p>
        </div>
    </div>
</div>
