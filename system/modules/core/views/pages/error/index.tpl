<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="header"> 
        <div class="container-fluid">
            <div class="navbar-header" style="color: white;">
                <div class="brand">
                    <h3> {if isset($title)} {$title} {/if}</h3>
                </div>
            </div>
        </div>

    </div>
</nav>

<div style="padding-top: 45px;"></div>

    {if isset($message)} {$message} {/if}
    <p>&nbsp;</p>
    <a href="{$layoutParams.root}" style="text-decoration: none;"> Go to Home Page </a> | 
    <a href="javascript:history.back(1)" style="text-decoration: none;"> Go to Back </a>
