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

{*    <ul class="nav nav-tabs">
        <li role="presentation" class="active"> <a href="{$layoutParams.root}user/profile/{$user.username}" aria-controls="timeline"> Timeline </a></li>
        <li role="presentation"> <a href="{$layoutParams.root}user/profile/about" aria-controls="about"> About </a></li>
        <li role="presentation"><a href="{$layoutParams.root}user/profile/message" aria-controls="message"> Message </a></li>
        <li role="presentation"><a href="{$layoutParams.root}user/profile/activity" aria-controls="activity"> Activity </a></li>
    </ul>*}
    <ul class="nav nav-tabs">
        <li role="presentation" class="active"> <a href="#timeline" aria-controls="timeline" role="tab" data-toggle="tab"> Timeline </a></li>
        <li role="presentation"> <a href="#about" aria-controls="about" role="tab" data-toggle="tab"> About </a></li>
        <li role="presentation"><a href="#message" aria-controls="message" role="tab" data-toggle="tab"> Message </a></li>
        <li role="presentation"><a href="{$layoutParams.root}user/profile/activities" aria-controls="activity"> Activity </a></li>
    </ul>

    <div>
        <!-- Tab panes -->
        <div class="tab-content"  role="tablist">
            <div role="tabpanel" class="tab-pane fade in active" id="timeline">
                <p align="justify"> Your time line here
                </p>
            </div>
            <div role="tabpanel" class="tab-pane fade in" id="about">
                <p align="justify"> Your about here. 
                </p>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="message">
                <p align="justify"> Your message here.
                </p>
            </div>
{*            <div role="tabpanel" class="tab-pane fade" id="activity">
                <p align="justify"> Your activity here.
                </p>
            </div>*}
        </div>
    </div>
{/if}

