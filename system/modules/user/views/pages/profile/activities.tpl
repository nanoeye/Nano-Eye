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
    <ul class="nav nav-tabs">
        <li role="presentation"><a href="{$layoutParams.root}user/profile" aria-controls="timeline"> Timeline </a></li>
        <li role="presentation"><a href="#about" aria-controls="about" role="tab" data-toggle="tab"> About </a></li>
        <li role="presentation"><a href="#message" aria-controls="message" role="tab" data-toggle="tab"> Message </a>
        </li>
        <li role="presentation" class="active"><a href="{$layoutParams.root}user/profile/activities"
                                                  aria-controls="activity"> Activity </a></li>
    </ul>
    <div>
        <!-- Tab panes -->
        <div class="tab-content" role="tablist">
            <div role="tabpanel" class="tab-pane fade in active" id="activity">
                <p align="justify">

                    {*<div class="panel panel-primary">
                        <div class="panel-heading">
                            <span class="lead"> Users</span>
                        </div>

                        <div class="panel-body">
                <p>


                    {if isset($users) && count($users)}
                <table class="table table-condensed table-responsive table-striped table-hover text-center small">

                    <tr class="success">
                        <td> Id</td>
                        <td> Profile Photo</td>
                        <td class="text-left"> Name</td>
                        <td class="text-left"> Email</td>
                        <td> Password</td>
                        <td> Username</td>
                        <td> Activity</td>
                        <td> Role</td>
                        <td> Status</td>
                        <td> Registration Date</td>
                        <td> Action</td>
                    </tr>
                    {foreach from = $users item = us}
                        <tr>
                            <td> {$us.id}                   </td>
                            <td>
                                <a href="{$layoutParams.root}acl/users/upload_profile_photo/{$us.username}"
                                   class="img-responsive img-thumbnail" title="Click change user's profile photo">

                                    {if empty($us.pro_pic)}
                                        <img src="{$layoutParams.profile_photos}DfaultProfileImage.png"
                                             style="width: 25px; height: 25px;"/>
                                    {else}
                                        <img src="{$layoutParams.profile_photos}{$us.pro_pic}"
                                             style="width: 25px; height: 25px;"/>
                                    {/if}

                                </a>
                            </td>
                            <td class="text-left">
                                <a href="{$layoutParams.root}user/profile/{$us.username}"
                                   style="text-decoration: none;">
                                    {$us.f_name} {$us.l_name}
                                </a>
                            </td>
                            <td class="text-left">
                                {$us.email}
                            </td>
                            <td class="text-left">
                                {Hash::getReal($us.password)}
                            </td>
                            <td> {$us.username}             </td>
                            <td> {$us.activity}             </td>
                            <td> {$us.role}                 </td>
                            <td> {if $us.status = 0} {'Unverified'} {else} {'Verified'} {/if}              </td>
                            <td> {$us.r_date}               </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-primary dropdown-toggle btn-xs"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false">
                                        Action
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{$layoutParams.root}acl/users/edit/{$us.id}" class=" small">Edit</a>
                                        </li>
                                        <li><a href="{$layoutParams.root}acl/users/delete/{$us.id}"
                                               class=" small">Delete</a></li>

                                    </ul>
                                </div>
                            </td>
                        </tr>
                    {/foreach}

                    <tr class="success">
                        <td> Id</td>
                        <td> Profile Photo</td>
                        <td class="text-left"> Name</td>
                        <td class="text-left"> Email</td>
                        <td> Password</td>
                        <td> Username</td>
                        <td> Activity</td>
                        <td> Role</td>
                        <td> Status</td>
                        <td> Registration Date</td>
                        <td> Action</td>
                    </tr>

                </table>
                {else}
                {"No data exists."}
                {/if}

                </p>
            </div>
        </div>*}

        <div class="text-center">
            {$pagination|default:""}
        </div>

        </p>
    </div>
    </div>
    </div>
{/if}

