<div class="panel panel-primary">
    <div class="panel-heading">
        <span class="lead"> Users</span>
    </div>

    <div class="panel-body">
        <p>

        <div>
            <div class="pull-right">
                <a href="{$layoutParams.root}acl/users/new_user" class="btn btn-success"
                   style="text-decoration: none">
                    <i class="fa fa-user-plus"></i> Add New User </a>
            </div>
            <div class="pull-left">
                <a href="{$layoutParams.root}acl" class="btn btn-warning">
                    <i class="fa fa-backward"></i>
                    Go Back
                </a>
            </div>
        </div>

            {if isset($users) && count($users)}
        <table class="table table-condensed table-responsive table-striped table-hover text-center small">

            <tr class="success">
                <td> Id</td>
                <td> Profile Photo </td>
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
                        <a href="{$layoutParams.root}user/profile/{$us.username}" style="text-decoration: none;">
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
                <td> Id </td>
                <td> Profile Photo </td>
                <td class="text-left"> Name </td>
                <td class="text-left"> Email </td>
                <td> Password </td>
                <td> Username </td>
                <td> Activity </td>
                <td> Role </td>
                <td> Status </td>
                <td> Registration Date </td>
                <td> Action </td>
            </tr>

        </table>
            
            {else}
                    {"No data exists."}
        {/if}

        </p>
    </div>
</div>

<div class="text-center">
    {$pagination|default:""}
</div>
