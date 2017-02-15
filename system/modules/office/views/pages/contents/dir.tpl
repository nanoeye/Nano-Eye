<button type="button" class="close icon-white" aria-hidden="true" data-toggle="modal" data-target="#myModal">
    <span class="fa fa-plus"></span>
    New Folder
</button>

<div>
    <div class="lead">
        Job item
        <hr/>
    </div>
    {if isset($oj_files) && count($oj_files)}
        {foreach from = $oj_files item = ojf}
            <div class="col-md-2 ">
            <span type="button" class="btn btn-lg" data-toggle="tooltip" data-placement="bottom"
                  title="{$ojf.ojf_name}">
                <a href="{$layoutParams.root}office/contents/dir/{$ojf.ojf_id}">
                    <span class="fa fa-{$ojf.ojf_icon}">
                        <span class="text-left">
                            {$ojf.ojf_name}
                        </span>
                    </span>
                </a>
            </span>
            </div>
        {/foreach}

    {else}

        {'No file exists.'}

    {/if}
</div>




<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">

        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Create New Folder</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <!-- JavaScript Includes -->
{*    <script src="/public/js/jquery.min.js"></script>
    <script src="/public/js/plugin/modal.js"></script>*}


    <!-- JavaScript Test -->
    <script>
        $(function () {
            $('#tall-toggle').click(function () {
                $('#tall').toggle()
            })
        })
    </script>
