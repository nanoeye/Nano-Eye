



<div align="center"> 
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
        Upload
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> [<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>]
                    Add new word </h4>
            </div>
            <div class="modal-body">

                <p>
                <form id="form1" method="post" action="">
                    <input type="hidden" name="add" value="1">

                    <p>Word: <br/>
                        <input class="form-control" type="text" name="word" placeholder="Type new word.." required="1" value="{if isset($data.word)} {$data.word} {/if}">  </p>

                    <p>Spelling: <br/>
                        <input class="form-control" type="text" name="spelling" placeholder="Type new word's spelling.." required="1" value="{if isset($data.spelling)} {$data.spelling} {/if}">  </p>

                    <fieldset>
                        <legend>Image</legend>

                        <input type="file" name="image" required="1"> 
                    </fieldset>

                    <p>Meaning: <br/>
                        <textarea class="form-control" name="meaning"> {if isset($data.meaning)} {$data.meaning} {/if} </textarea> </p>

                    <p>Related words: <br/>
                        <input class="form-control" type="search" name="r_word" placeholder="Type related word's.." value="{if isset($data.r_word)} {$data.r_word} {/if}">  </p>

                    <p>Example: <br/>
                        <textarea class="form-control" name="examples">{if isset($data.examples)}{$data.examples}{/if} </textarea> </p>

                    <button type="reset" class="btn btn-danger">
                        <span class="fa fa-eraser"> </span> Reset</button> 

                    <button type="submit" class="btn btn-primary"> 
                        <span class="fa fa-save"> </span> Add</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" role="button" data-dismiss="modal">Close</button> 
            </div>
        </div>
    </div>
</div>
