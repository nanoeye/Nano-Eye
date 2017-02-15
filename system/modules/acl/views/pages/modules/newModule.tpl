<div class="col-md-8 col-md-offset-2">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="lead"> New Module </span>
        </div>
        <div class="panel-body">
            <p>
            <div class="col-md-8 col-md-offset-2">

                <form name="form1" enctype="multipart/form-data" method="post" action="" role="form" />
                    <input type="hidden" name="add" value="1"/>

                    <span class="input-group">
                        <span class="input-group-addon">
                            Module:
                        </span>
                        <span class="input-group-addon">
                            <input type="file" name="module" required="1"/>
                        </span>
                    </span>

                    <br/>

                    <input type="submit" class="btn btn-primary" value="Upload"/>
                    <a href="{$layoutParams.root}acl/modules" class="btn btn-warning"> Go Back </a>

                </form>
            </div>
            </p>
        </div>
    </div>

</div>
