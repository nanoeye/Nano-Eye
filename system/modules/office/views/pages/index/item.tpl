<div class="col-md-8 col-md-offset-2">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="lead"> ALAN office item </span>
        </div>

        <div class="panel-body">
            <p>

                {if isset($jobs_cats) && count($jobs_cats)}

            <table class="table table-condensed table-responsive table-striped table-hover">

                <tr class="success">
                    <th class="text-center">Id</th>
                    <th> Name</th>
                    <th> Title</th>
                    <th> Url</th>
                    <th class="text-center"> Icon</th>
                    <th class="text-center"> Action</th>
                </tr>

                {foreach from= $jobs_cats item = jc}
                    <tr>
                        <td class="text-center">
                            {$jc.oj_id}
                        </td>
                        <td>{$jc.oj_name}</td>
                        <td>{$jc.oj_title}</td>
                        <td>
                            {$jc.oj_url}
                        </td>
                        <td class="text-center"><span class="fa fa-{$jc.oj_icon}"></span></td>

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
                                    <li><a href="{$layoutParams.root}office/index/edit/{$jc.oj_id}" class=" small">Edit</a>
                                    </li>
                                    <li><a href="{$layoutParams.root}office/index/delete/{$jc.oj_id}"
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
                    <a href="{$layoutParams.root}office/index/newItem" class="btn btn-success"> New item </a>
                    <a href="{$layoutParams.root}office" class="btn btn-warning"> Go Back </a>
                </span>
            </p>
            </p>
        </div>
    </div>

</div>
