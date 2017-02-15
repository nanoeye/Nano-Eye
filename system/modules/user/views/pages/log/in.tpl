<div class="col-md-8 col-md-offset-2">
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"> Log In</h3>
        </div>
        <div class="panel-body">
            <form role="form" name="form1" method="post" action="">
                <input type="hidden" name="enviar" value="1">

                <div class="input-group">
            <span class="input-group-addon" id="sizing-addon2">
                <span class="glyphicon glyphicon-user" aria-hidden="true">
                </span>
            </span>
                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus
                           required="1" value="{if isset($datas)}{$datas.username}{/if}">
                </div><!-- /input-group -->
                <br/>
                <div class="input-group">
            <span class="input-group-addon" id="sizing-addon2">
                <span class="fa fa-key glyphicon glyphicon-lock" aria-hidden="true">
                </span>
            </span>
                    <input class="form-control" placeholder="Password" name="password" type="password"
                           value=""
                           required="1">
                </div><!-- /input-group -->
                <div class="checkbox">
                    <label>
                        <input name="remember" type="checkbox" value="Remember Me" required="1">Remember Me
                    </label>
                </div>
                <!-- Change this to a button or input when using this as a form -->
                <input type="submit" value="Log in" class="btn btn-lg btn-success btn-block"/> <br/>
                Have no account. <a href="{$layoutParams.root}user/reg" style="text-decoration: none"
                                    class="text-primary">
                    Create new account.
                </a> {*|| or ||*}
                <a href="{$layoutParams.root}" class="text-success" style="text-decoration: none"> Go Back Home </a>
            </form>
        </div>
    </div>
</div>
