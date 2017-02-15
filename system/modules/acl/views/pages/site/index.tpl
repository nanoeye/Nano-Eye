<div class="panel panel-primary">
    <div class="panel-heading">
        <span class="lead"> Site Information </span>
    </div>

    <div class="panel-body">
        <p>

            {if isset($siteInfo) && count($siteInfo)}

        <table class="table table-condensed table-bordered table-responsive table-striped table-hover small text-justify">

            <tr class="success">
                <th class="text-center"> Id</th>
                <th> Name</th>
                <th> Slogan</th>
                <th class="text-center"> Company</th>
                <th> Site Root</th>
                <th class="text-center"> Host</th>
				<th class="text-center"> Host IP </th>
                <th class="text-center"> Default Home</th>
                <th class="text-center"> Icon</th>
                <th> Icon dir</th>
                <th class="text-center"> Action</th>
            </tr>

            {foreach item = si from= $siteInfo}
                <tr>
                    <td class="text-center">{$si.id}</td>
                    <td>{$si.name}</td>
                    <td>{$si.slogan}</td>
                    <td>{$si.company}</td>
                    <td>{$si.doc_root}</td>

                    <td class="text-center">
                        <a href="{$si.http_host_add}"
                           style="text-decoration: none"> View </a>
                    </td>
					
					<td class="text-center"> {$si.http_host_ip}</td>
                    <td class="text-center"> {$si.default_home}</td>

                    <td class="text-center">
                        <a href="{$layoutParams.root}acl/site/upload_logo/{$si.id}"
                           class="img-responsive img-thumbnail" title="Click change favicon">

                            {if empty($si.favicon)}
                                <img src="{$layoutParams.root}favicon.ico"
                                     style="width: 25px; height: 25px;"/>
                            {else}
                                <img src="{$si.icon_dir}{$si.favicon}"
                                     style="width: 25px; height: 25px;"/>
                            {/if}

                        </a>

                    </td>
                    <td> {$si.icon_dir}</td>

                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <a href="{$layoutParams.root}acl/site/edit/{$si.id}" class="btn btn-success small"> Edit </a>
                        </div>
                    </td>
                </tr>
            {/foreach}
 
            <tr class="success">
                <th class="text-center"> Id</th>
                <th> Name</th>
                <th> Slogan</th>
                <th class="text-center"> Company</th>
                <th> Site Root</th>
                <th class="text-center"> Host</th>
				<th class="text-center"> Host IP </th>
                <th class="text-center"> Default Home</th>
                <th class="text-center"> Icon</th>
                <th> Icon dir</th>
                <th class="text-center"> Action</th>
            </tr>

        </table>
            
            {else}
                    {"No data exists."}
        {/if}

        <p>

            <span class="form-inline">
                <a href="{$layoutParams.root}acl" class="btn btn-warning"> Go Back </a>
            </span>
        </p>
        </p>
    </div>
</div>
