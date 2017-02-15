<div class="col-md-8 col-md-offset-2">

    <div class="panel panel-primary">

        <div class="panel-heading">
            <span class="lead"> New user </span>
        </div>

        <div class="panel-body">
            <p>
                <form name="form1" method="post" action="" role="form">
                <input type="hidden" name="add" value="1"/>

                <span class="text-danger">(*) marked field you must filled up.</span>
                <table class="table">
                    <tr>
                        <td> First Name: <span class="text-danger">*</span> </td>
                        <td>
                            <input type="text" name="f_name" class="form-control" placeholder="User's first name."
                                    value="{if isset($data)}{$data.f_name}{/if}" required="1"/>
                        </td>
                    </tr>

                    <tr>
                        <td> Last Name:</td>
                        <td>
                            <input type="text" name="l_name" class="form-control" placeholder="User's last name."
                                   value="{if isset($data)}{$data.l_name}{/if}"/>
                        </td>
                    </tr>

                    <tr>
                        <td> Email address:<span class="text-danger">*</span></td>
                        <td>
                            <span class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input type="email" name="email" class="form-control" placeholder="User's email address."
                                       value="{if isset($data)}{$data.email}{/if}" required="1"/>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td> Username:<span class="text-danger">*</span></td>
                        <td>
                            <span class="input-group">
                                <span class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input type="text" name="username" class="form-control" placeholder="User's username."
                                           value="{if isset($data)}{$data.username}{/if}" required="1"/>
                                </span>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td> New Password:<span class="text-danger">*</span></td>
                        <td>
                            <span class="input-group">
                                <span class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-key"></i>
                                    </span>
                                    <input type="password" name="password" class="form-control" placeholder="New Password."/>
                                </span>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td> Confirm Password:<span class="text-danger">*</span></td>
                        <td>
                            <span class="input-group">
                                <span class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-key"></i>
                                    </span>
                                    <input type="password" name="c_password" class="form-control" placeholder="Confirm password."
                                        value="" {if isset($data.password)} required="1"{/if}/>
                                </span>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td> Date of Birth:<span class="text-danger">*</span></td>
                        <td>
                            <span class="input-group">
                                <span class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="date" id="date" name="dob" class="form-control" placeholder="example: 01/01/1996."
                                           value="{if isset($data)}{$data.dob}{/if}" required="1"/>

                                </span>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td> Gender:<span class="text-danger">*</span></td>
                        <td>
                            <span id="controlgroup">
                                <select name="gender" class="form-control">
                                    <option value=""> Select gender </option>
                                    <option value="male" {if isset($data) && ($data.gender == 'male')} selected="selected" {/if} >
                                        Male
                                    </option>
                                    <option value="female" {if isset($data) && ($data.gender == 'female')} selected="selected" {/if} >
                                        Female
                                    </option>
                                </select>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td> Role:<span class="text-danger">*</span></td>
                        <td>
                            {if isset($roles) && count($roles)}

                                <span id="controlgroup1">
                                    <select name="role" class="form-control">
                                        <option value=""> Select role </option>

                                        {foreach from = $roles item = r}

                                            <option value="{$r.id_role}" {if isset($data) && ($data.role == $r.id_role)} selected="selected" {/if}> {$r.role} </option>

                                        {/foreach}

                                    </select>
                                </span>

                            {/if}

                        </td>
                    </tr>

                    <tr>
                        <td> Profession:</td>
                        <td>
                            <span id="controlgroup2">
                                <select name="profession" class="form-control">
                                    <option value=""> Select profession </option>
                                    <option value="Student" {if isset($data) && ($data.profession == 'Student')} selected="selected" {/if} > Student </option>
                                    <option value="Employee" {if isset($data) && ($data.profession == 'Employee')} selected="selected" {/if} > Employee </option>
                                    <option value="Businessman" {if isset($data) && ($data.profession == 'Businessman')} selected="selected" {/if} > Businessman </option>
                                    <option value="Job Seeker" {if isset($data) && ($data.profession == 'Job Seeker')} selected="selected" {/if} > Job Seeker </option>
                                    <option value="Housewife" {if isset($data) && ($data.profession == 'Housewife')} selected="selected" {/if} > Housewife </option>
                                    <option value="others" {if isset($data) && ($data.profession == 'others')} selected="selected" {/if} > others </option>
                                </select>
                            </span>
                        </td>
                    </tr>
                </table>

                    <input type="submit" class="btn btn-primary" value="Next"/>
                    <a href="{$layoutParams.root}acl/users" class="btn btn-warning"> Go Back </a>

                </form>
            </p>
        </div>
    </div>

</div>


<script src="http://web.alan.local/system/themes/liteboot/js/jquery-ui.js"></script>
<script>

    $( "#controlgroup" ).controlgroup();
    $( "#controlgroup1" ).controlgroup();
    $( "#controlgroup2" ).controlgroup();
    $( "#controlgroup3" ).controlgroup();

    $( "#date" ).datepicker({
        showAnim: 'slideDown',
        numberOfMonths:1,
        dateFormat: 'dd/mm/yy',
        onClose: function (selectDate) {
            $("#date").datepicker_instActive,
                    $("#date").datepicker("option", "maxDate", selectDate);
        }
    });
</script>
