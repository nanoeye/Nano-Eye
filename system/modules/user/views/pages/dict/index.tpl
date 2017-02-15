<div class="nav-custom navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <div class="navbar-brand">
                Computer Dictionary
            </div>
        </div>
        {if $acl->permision('new_word')}
            <div class="nav navbar-nav navbar-right">
                <li>
                    <a href="{$layoutParams.root}user/dict/new_word" class="btn btn-success"> <span
                                class="glyphicon glyphicon-plus"> </span> Add new word</a>
                </li>
            </div>
        {/if}
    </div>
</div>

{if isset($words) && count($words)}
    <table class="table table-condensed table-bordered table-responsive table-striped table-hover">

        <tr align="center" class="success">
            <td width="10px"> #</td>
            <td width="30px"> Word</td>
            <td width="70px"> Spelling</td>
            <td width="450px"> Meaning</td>
            <td width="80px"> Photo</td>
            <td width="15px"> Action</td>
        </tr>

        {foreach item = datas  from =$words}
            <tr>
                <td align="center"> {$datas.id}         </td>
                <td align="center"> {$datas.word}       </td>
                <td align="center"> {$datas.spelling}   </td>
                <td align="Justify">
                    <a href="{$layoutParams.root}user/dict/view/{$datas.id}" style="text-decoration: none; color: black; display: block;">
                        {$datas.meaning} </a></td>
                <td align="center">
                    {if empty($datas.image)}

                        <img src="{$layoutParams.root}public/img/no_image.png"
                             class="img-responsive img-thumbnail"/>

                        {else}

                            <a href="{$layoutParams.uploads}{$datas.image}">
                                <img src="{$layoutParams.uploads}thumbs/thumb_{$datas.image}"
                                     class="img-responsive img-thumbnail"/>
                            </a>
                    {/if}
                </td>
                <td align="center">

                    {if $acl->permision('edit_word')}
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                Action
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="{$layoutParams.root}user/dict/view/{$datas.id}">View</a></li>
                                <li><a href="{$layoutParams.root}user/dict/edit/{$datas.id}">Edit</a></li>

                                {if $acl->permision('delete_word')}
                                    <li><a href="{$layoutParams.root}user/dict/delete/{$datas.id}">Delete</a></li>
                                {/if}

                            </ul>
                        </div>
                    {else}
                        <a href="{$layoutParams.root}user/dict/view/{$datas.id}" class="btn btn-primary"> <span
                                    class="glyphicon glyphicon-eye-open"></span> View </a>
                    {/if}
                </td>
            </tr>
        {/foreach}

        <tr align="center" class="success">
            <td> #</td>
            <td> Word</td>
            <td> Spelling</td>
            <td> Meaning</td>
            <td> Photo</td>
            <td> Action</td>
        </tr>
    </table>
{else}
    <p><strong> No word exists.</strong></p>
{/if}

<div class="text-center">
    {$pagination|default:""}
</div>
