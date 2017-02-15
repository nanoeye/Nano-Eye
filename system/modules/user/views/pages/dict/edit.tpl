<div class="content">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            Edit: {if isset($data.word)}{$data.word}{/if}
        </div>
        <div class="panel-body">
            <p>
            <form id="form1" method="post" action="">
                <input type="hidden" name="add" value="1">
                    <input type="hidden" name="add" value="1">
                    <p>Word: <br/>
                        <input class="form-control" type="text" name="word" placeholder="Type new word.." required="1" value="{if isset($data.word)}{$data.word}{/if}">  </p>
                    <p>Spelling: <br/>
                        <input class="form-control" type="text" name="spelling" placeholder="Type new word's spelling.." required="1" value="{if isset($data.spelling)}{$data.spelling}{/if}">  </p>
                    <p>Meaning: <br/>
                        <textarea class="form-control" name="meaning">{if isset($data.meaning)}{$data.meaning}{/if}</textarea> </p>
                    <p>Related words: <br/>
                        <input class="form-control" type="search" name="r_word" placeholder="Type related word's.." value="{if isset($data.r_word)}{$data.r_word}{/if}">  </p>
                    <p>Example: <br/>
                        <textarea class="form-control" name="examples">{if isset($data.examples)}{$data.examples}{/if}</textarea> </p>
                    <button type="submit" class="btn btn-primary"> 
                        <span class="glyphicon glyphicon-floppy-save"> </span> Update</button>
                    <a href="javascript:history.back(1)" class="btn btn-danger"> &times; Cancel</a>
            </form>
            </p>
        </div>
    </div>
</div>
