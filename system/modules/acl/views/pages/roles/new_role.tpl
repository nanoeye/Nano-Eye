<div class="col-md-8 col-md-offset-2">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="lead"> New Role </span>
        </div>
        <div class="panel-body">
            <p>
            <div class="col-md-6 col-md-offset-2">

                <form name="form1" method="post" action="" role="form">
                    <input type="hidden" name="add" value="1"/>

                    <span class="input-group">
                        <span class="input-group-addon">
                            Name:
                        </span>
                        <input type="text" name="role" class="form-control" placeholder="New Role Name" required="1"/>
                    </span>

                    <br/>

                    <input type="submit" class="btn btn-primary" value="Add"/>
                    <a href="{$layoutParams.root}acl/roles" class="btn btn-warning"> Go Back </a>

                </form>
            </div>
            </p>
        </div>
    </div>

</div>
