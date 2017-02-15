<div class="col-md-8 col-md-offset-2">
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"> Sign Up</h3>
        </div>
        <div class="panel-body">
            <form id="form1" role="form" name="form1" method="post">
                <input type="hidden" name="enviar" value="1">
                <span class="input-group">
                    <span class="input-group-addon" id="sizing-addon2">
                        First Name:
                        </span>
                    <input class="form-control" placeholder="Enter your first name." name="f_name" type="text" autofocus
                           required="1" value="{if isset($datas)}{$datas.f_name}{/if}">
                </span> <!-- /input-group-->
                <br/>
            <span class="input-group">
                    <span class="input-group-addon" id="sizing-addon2">
                        Last Name:
                        </span>
                    <input class="form-control" placeholder="Enter your first name." name="l_name" type="text" autofocus
                           required="1" value="{if isset($datas)}{$datas.l_name}{/if}">
                </span> <!-- /input-group-->
                <br/>
                <span class="input-group">
                    <span class="input-group-addon" id="sizing-addon2">
                        <span class="glyphicon glyphicon-user" aria-hidden="true">
                        </span>
                    </span>
                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus
                           required="1" value="{if isset($datas)}{$datas.username}{/if}">
                </span><!-- /input-group -->
                <br/>
                <span class="input-group">
                    <span class="input-group-addon" id="sizing-addon2">
                        <span class="fa fa-envelope" aria-hidden="true">
                        </span>
                    </span>
                    <input class="form-control" placeholder="Email address." name="email" type="email" autofocus
                           required="1" value="{if isset($datas)} {$datas.email} {/if}">
                </span><!-- /input-group -->
                <br/>
                <span class="input-group">
                    <span class="input-group-addon" id="sizing-addon2">
                        <span class="fa fa-key" aria-hidden="true">
                        </span>
                    </span>
                    <input class="form-control" placeholder="Password" name="password" type="password" value=""
                           required="1">
                </span><!-- /input-group -->
                <br/>
                <span class="input-group">
                    <span class="input-group-addon" id="sizing-addon2">
                        <span class="fa fa-key" aria-hidden="true">
                        </span>
                    </span>
                    <input class="form-control" placeholder="Confirm Password" name="c_password" type="password"
                           value="" required="1">
                </span><!-- /input-group -->
                <br/>
                <span class="checkbox">
                    <label>
                        <input name="agree" type="checkbox" value="Remember Me" required="1"> I agree with all terms and conditions.
                    </label>
                </span>
                <div class="text-left">

                    <input type="submit" value="Sign Up" class="btn btn-md btn-success"/>
                    <br/>
                    You have already an account.
                    <a href="{$layoutParams.root}user/log/in" class="text-primary" style="text-decoration: none">
                        Log In.
                    </a> {*|| or ||*}
                    <a href="{$layoutParams.root}" class="text-success" style="text-decoration: none"> Go Back Home </a>
                </div>
            </form>
        </div>
    </div>
</div>