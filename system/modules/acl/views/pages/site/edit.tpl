<div class="col-md-8 col-md-offset-2">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="lead"> Edit Site Information </span>
        </div>

        <div class="panel-body">
            <p>

                {if isset($site) && count($site)}

            <form name="form1" method="post" action="" role="form">
                <input type="hidden" name="add" value="1"/>

                {foreach item = s from= $site}
                    <span class="input-group">
                        <span class="input-group-addon">
                            Name:
                        </span>
                        <input type="text" name="name" class="form-control"
                               placeholder="{if isset($s.name)}{$s.name}{/if}"
                               value="{if isset($data.name)}{$data.name}{/if}"
                               maxlength="40"/>
                    </span>
                    <br/>
                    <span class="input-group">
                        <span class="input-group-addon">
                            Slogan:
                        </span>
                        <textarea type="text" name="slogan" class="form-control"
                               placeholder="{if isset($s.slogan)}{$s.slogan}{/if}"
                               maxlength="100">{if isset($data.slogan)}{$data.slogan}{/if}</textarea>
                    </span>
                    <br/>
                    <span class="input-group">
                        <span class="input-group-addon">
                            Company:
                        </span>
                        <input type="text" name="company" class="form-control"
                               placeholder="{if isset($s.company)}{$s.company}{/if}"
                               value="{if isset($data.company)}{$data.company}{/if}"
                               maxlength="40" readonly/>
                    </span>
                    <br/>
                    <span class="input-group">
                        <span class="input-group-addon">
                            Root:
                        </span>
                        <input type="text" name="doc_root" class="form-control"
                               placeholder="{if isset($s.doc_root)}{$s.doc_root}{/if}"
                               value="{if isset($data.doc_root)}{$data.doc_root}{/if}"
                               maxlength="40"/>
                    </span>
                    <br/>
                    <span class="input-group">
                        <span class="input-group-addon">
                            Host:
                        </span>
                        <input type="text" name="http_host_add" class="form-control"
                               placeholder="{if isset($s.http_host_add)}{$s.http_host_add}{/if}"
                               value="{if isset($data.http_host_add)}{$data.http_host_add}{/if}"
                               maxlength="40"/>
                    </span>
                    <br/>
					<span class="input-group">
                        <span class="input-group-addon">
                            Host IP:
                        </span>
                        <input type="text" name="http_host_ip" class="form-control"
                               placeholder="{if isset($s.http_host_ip)}{$s.http_host_ip}{/if}"
                               value="{if isset($data.http_host_ip)}{$data.http_host_ip}{/if}"
                               maxlength="30" readonly/>
                    </span>
                    <br/>
                    <span class="input-group">
                        <span class="input-group-addon">
                            Default home:
                        </span>
                        <input type="text" name="dafault_home" class="form-control"
                               placeholder="{if isset($s.default_home)}{$s.default_home}{/if}"
                               value="{if isset($data.default_home)}{$data.default_home}{/if}"
                               maxlength="60"/>
                    </span>
                    <br/>
                    <input type="submit" class="btn btn-primary" value="Update"/>
                    <a href="{$layoutParams.root}acl/site" class="btn btn-warning"> Go Back </a>
                {/foreach}

            </form>

            {/if}

            </p>
        </div>
    </div>

</div>
