<div class="col-md-8 col-md-offset-2">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="lead"> Acl item </span>
        </div>

        <div class="panel-body">
            <p>

                {if isset($acl_menu) && count($acl_menu)}

            <table class="table table-condensed table-responsive table-striped table-hover">

                <tr class="success">
                    <th class="text-center">Id</th>
                    <th> Name</th>
                    <th> Title</th>
                    <th> Url</th>
                    <th class="text-center"> Icon</th>
                    <th class="text-center"> Action</th>
                </tr>

                {foreach from= $acl_menu item = al}
                    <tr>
                        <td class="text-center">
                            {$al.am_id}
                        </td>
                        <td>{$al.am_name}</td>
                        <td>{$al.am_title}</td>
                        <td>
                            {$al.am_url}
                        </td>
                        <td class="text-center"><span class="fa fa-{$al.am_icon}"></span></td>

                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary dropdown-toggle btn-xs"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                    Action
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="{$layoutParams.root}acl/index/edit/{$al.am_id}" class=" small">Edit</a>
                                    </li>
                                    <li><a href="{$layoutParams.root}acl/index/delete/{$al.am_id}"
                                           class=" small">Delete</a></li>

                                </ul>
                            </div>
                        </td>
                    </tr>
                {/foreach}

                <tr class="success">
                    <th class="text-center">Id</th>
                    <th> Name</th>
                    <th> Title</th>
                    <th> Url</th>
                    <th class="text-center"> Icon</th>
                    <th class="text-center"> Action</th>
                </tr>

            </table>

            {else}

            {'No item exists.'}

            {/if}

            <p>
                <span class="form-inline">
                    <a href="{$layoutParams.root}acl/index/newItem" class="btn btn-success"> New item </a>
                    <a href="{$layoutParams.root}acl" class="btn btn-warning"> Go Back </a>
                </span>
            </p>
            </p>
        </div>
    </div>

</div>
