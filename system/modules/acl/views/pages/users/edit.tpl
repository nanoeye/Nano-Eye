<div class="col-md-8 col-md-offset-2">

    <div class="panel panel-primary">

        <div class="panel-heading">
            <span class="lead"> Edit: {if isset($Edata)}{$Edata.username}{else}{if !empty(isset($data.username))}{$data.username}{/if}{/if} </span>
        </div>

        <div class="panel-body">
            <p>
            <form name="form1" method="post" action="" role="form">
                <input type="hidden" name="add" value="1"/>

                <span class="text-danger"> Your updated information user must be carry out. </span>
                <table class="table">
                    <tr>
                        <td> First Name:</td>
                        <td>
                            <input type="text" name="f_name" class="form-control"
                                   placeholder="{if isset($Edata)}{$Edata.f_name}{/if}"
                                   value="{if !empty(isset($data.f_name))}{$data.f_name}{/if}"/>
                        </td>
                    </tr>

                    <tr>
                        <td> Last Name:</td>
                        <td>
                            <input type="text" name="l_name" class="form-control" placeholder="{if empty(isset($Edata.l_name))}{'Please enter last name.'}{else}{$Edata.l_name}{/if}" value="{if !empty(isset($data.l_name))}
                            {$data.l_name}{/if}"/>
                        </td>

                    </tr>

                    <tr>
                        <td> Email address:</td>
                        <td>
                            <span class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input type="email" name="email" class="form-control"
                                       placeholder="{if isset($Edata)}{$Edata.email}{/if}"
                                       value="{if !empty(isset($data))}{$data.email}{/if}"/>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td> Username:</td>
                        <td>
                            <span class="input-group">
                                <span class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input type="text" name="username" class="form-control"
                                           placeholder="{if isset($Edata)}{$Edata.username}{/if}"
                                           value="{if !empty(isset($data))}{$data.username}{/if}"
                                           {if !$acl->permision('root_access')}readonly {/if} />
                                </span>
                            </span>

                        </td>
                    </tr>

                    <tr>
                        <td> New Password:</td>
                        <td>
                            <span class="input-group">
                                <span class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-key"></i>
                                    </span>
                                    <input type="password" name="password" class="form-control"
                                           placeholder="New Password."/>
                                </span>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td> Confirm Password:</td>
                        <td>
                            <span class="input-group">
                                <span class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-key"></i>
                                    </span>
                                    <input type="password" name="c_password" class="form-control"
                                           placeholder="Confirm password."/>
                                </span>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td> Date of Birth:</td>
                        <td>
                            <span class="input-group">
                                <span class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="date" id="date" name="dob" class="form-control"
                                           placeholder="{if isset($Edata)}{$Edata.dob}{/if}"
                                           value="{if !empty(isset($data))}{$data.dob}{/if}"/>

                                </span>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td> Gender:</td>
                        <td>
                            <span id="controlgroup">
                                <select name="gender" class="form-control">
                                    <option value=""> Select gender </option>
                                    <option value="male" {if isset($Edata) && ($Edata.gender == 'male') || isset($data)
                                    && ($data.gender == 'male')} selected="selected" {/if} >
                                        Male
                                    </option>
                                    <option value="female" {if isset($Edata) && ($Edata.gender == 'female') || isset($data)
                                    && ($data.gender == 'female')} selected="selected" {/if} >
                                        Female
                                    </option>
                                </select>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td> Role:</td>
                        <td>
                            <span id="controlgroup1">
                                <select name="role" class="form-control">
                                    <option value=""> Select role </option>

                                    {if isset($roles) && count($roles)}
                                        {foreach from = $roles item = r}
                                            <option value="{$r.id_role}" {*{if isset($data) && ($data.role == $r.id_role)||
                                            isset($Edata) && ($Edata.role == $r.id_role)}
                                            selected="selected" {/if}*}> {$r.role} </option>
                                        {/foreach}
                                    {/if}

                                </select>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td> Profession:</td>
                        <td>
                            <span id="controlgroup2">
                                <select name="profession" class="form-control">
                                    <option> Select profession </option>

                                    <option value="Student" {if isset($Edata) && ($Edata.profession == 'Student')
                                    || isset($data) && ($data.profession == 'Student')} selected="selected" {/if} >
                                        Student
                                    </option>

                                    <option value="Employee" {if isset($Edata) && ($Edata.profession == 'Employee')
                                    || isset($data) && ($data.profession == 'Employee')} selected="selected" {/if} >
                                        Employee
                                    </option>

                                    <option value="Businessman" {if isset($Edata) && ($Edata.profession == 'Businessman')
                                    || isset($data) && ($data.profession == 'Businessman')} selected="selected" {/if} >
                                        Businessman
                                    </option>

                                    <option value="Job Seeker" {if isset($Edata) && ($Edata.profession == 'Job Seeker')
                                    || isset($data) && ($data.profession == 'Job Seeker')} selected="selected" {/if} >
                                        Job Seeker
                                    </option>

                                    <option value="Housewife" {if isset($Edata) && ($Edata.profession == 'Housewife')
                                    || isset($data) && ($data.profession == 'Housewife')} selected="selected" {/if} >
                                        Housewife
                                    </option>

                                    <option value="others" {if isset($Edata) && ($Edata.profession == 'others')
                                    ||  isset($data) && ($data.profession == 'others')} selected="selected" {/if} >
                                        others
                                    </option>
                                </select>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td> Activity:</td>
                        <td>
                            <span id="controlgroup3">
                                <span class="input-group">
                                    <select name="activity" class="form-control">
                                        <option value=""> Select activity </option>
                                        <option value="active" {if isset($Edata) && ($Edata.activity == 'active')
                                        || isset($data) && ($data.activity == 'active')} selected="selected" {/if} >
                                            Active
                                        </option>

                                        <option value="Inactive" {if isset($Edata) && ($Edata.activity == 'Inactive')
                                        ||  isset($data) && ($data.activity == 'Inactive')} selected="selected" {/if} >
                                            Inactive
                                        </option>
                                    </select>
                                </span>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td> Registration Date:</td>
                        <td>
                            <input type="datetime" name="r_date" class="form-control disabled"
                                   value="{if !empty(isset($data))}{$data.r_date}{/if}"
                                   placeholder="{if isset($Edata)}{$Edata.r_date}{/if}"
                                   {if !$acl->permision('root_access')}readonly {/if} />
                        </td>
                    </tr>

                </table>

                <input type="submit" class="btn btn-primary" value="Update"/>
                <a href="javascript:history.back(1)" class="btn btn-warning"> Go Back </a>

            </form>

            </p>
        </div>
    </div>

</div>


<script src="http://web.alan.local/system/themes/liteboot/js/jquery-ui.js"></script>
<script>

    $("#controlgroup").controlgroup();
    $("#controlgroup1").controlgroup();
    $("#controlgroup2").controlgroup();
    $("#controlgroup3").controlgroup();

    $("#date").datepicker({
        showAnim: 'slideDown',
        numberOfMonths: 1,
        dateFormat: 'dd/mm/yy',
        onClose: function (selectDate) {
            $("#date").datepicker_instActive,
                    $("#date").datepicker("option", "maxDate", selectDate);
        }
    });
</script>
