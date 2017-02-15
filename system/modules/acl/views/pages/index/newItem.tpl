<div class="col-md-8 col-md-offset-2">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="lead"> New item </span>
        </div>

        <div class="panel-body">
            <p>

            <form name="form1" method="post" action="" role="form">
                <input type="hidden" name="add" value="1"/>

                <span class="input-group">
                        <span class="input-group-addon">
                            Name:
                        </span>
                        <input type="text" name="am_name" class="form-control"
                               placeholder="Please write item's name."
                               value="{if isset($data.am_name)}{$data.am_name}{/if}"
                               required="1" maxlength="60"/>
                    </span>
                <br/>
                <span class="input-group">
                        <span class="input-group-addon">
                            Title:
                        </span>
                        <input type="text" name="am_title" class="form-control"
                               placeholder="Please write item's title."
                               value="{if isset($data.am_title)}{$data.am_title}{/if}"
                               required="1" maxlength="40"/>
                    </span>
                <br/>
                <span class="input-group">
                        <span class="input-group-addon">
                            Url:
                        </span>
                        <input type="text" name="am_url" class="form-control"
                               placeholder="Please write item's url."
                               value="{if isset($data.am_url)}{$data.am_url}{/if}"
                               required="1" maxlength="60"/>
                    </span>
                <br/>
                <span class="input-group">
                        <span class="input-group-addon">
                            Icon:
                        </span>
                        <input type="text" name="am_icon" class="form-control"
                               placeholder="Please write item's icon."
                               value="{if isset($data.am_icon)}{$data.am_icon}{/if}"
                               required="1" maxlength="40"/>
                    </span>
                <br/>
                <input type="submit" class="btn btn-primary" value="add"/>
                <a href="{$layoutParams.root}acl/index/item" class="btn btn-warning"> Go Back </a>

            </form>

            </p>
        </div>
    </div>

</div>
