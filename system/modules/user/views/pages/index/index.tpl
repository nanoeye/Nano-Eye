{if isset($user)}
    <div class="well">
        <a href="{$layoutParams.root}user/profile/{$user.username}"
           class="img-responsive img-thumbnail" title="{$user.f_name} {$user.l_name}">
            <div class="img-responsive img-rounded">
                {if empty($user.pro_pic)}
                    <img src="{$layoutParams.profile_photos}DfaultProfileImage.png"
                         style="width: 40px; height: 40px;"/>
                {else}
                    <img src="{$layoutParams.profile_photos}{$user.pro_pic}"
                         style="width: 40px; height: 40px;"/>
                {/if}
            </div>
            {$user.f_name}
        </a>
    </div>
{/if}