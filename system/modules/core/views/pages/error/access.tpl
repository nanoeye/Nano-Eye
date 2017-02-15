<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header" style="color: white;">
            <h3> {if isset($title)} {$title} {/if} </h3>
        </div>
    </div>
</nav>

<div>
    {if isset($message)} {$message} {/if}
    <p>&nbsp;</p>
    <a href="{$layoutParams.root}" style="text-decoration: none;"> Go to Home Page </a> | 
    <a href="javascript:history.back(1)" style="text-decoration: none;"> Go to Back </a>

    {if !Session::get('auth')}
        | <a href="{$layoutParams.root}log/in" style="text-decoration: none;"> Login </a> 
    {/if}
</div>
