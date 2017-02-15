<div class="panel panel-primary">
    <div class="panel-heading">
        [<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>]
        Add new word
    </div>
    <div class="panel-body">
        <p>
            <form id="form1" method="post" enctype="multipart/form-data">
                <input type="hidden" name="add" value="1"/>

        <p>Word: <br/>
            <input class="form-control" type="text" name="word" placeholder="Type new word.." required="1"
                   value="{if isset($data.word)}{$data.word}{/if}"/></p>

        <p>Spelling: <br/>
            <input class="form-control" type="text" name="spelling" placeholder="Type new word's spelling.."
                   required="1" value="{if isset($data.spelling)}{$data.spelling}{/if}"/></p>

        <fieldset>
            <legend>Image</legend>

            <input type="file" name="image"/>
        </fieldset>

        <p>Meaning: <br/>
            <textarea class="form-control" name="meaning">{if isset($data.meaning)} {$data.meaning} {/if}</textarea></p>

        <p>Related words: <br/>
            <input class="form-control" type="search" name="r_word" placeholder="Type related word's.."
                   value="{if isset($data.r_word)}{$data.r_word}{/if}"/></p>

        <p>Example: <br/>
            <textarea class="form-control" name="examples">{if isset($data.examples)}{$data.examples}{/if} </textarea>
        </p>

        <p>Category: <br/>
            <select id="cat" name="cat" class="form-control">
                <option value=""> Select one</option>

                {if !empty(isset($cat) && count($cat))}
                    {foreach from = $cat item= "ct" }

                        <option value="{$ct.id_cat}"> {$ct.cat_name} </option>

                    {/foreach}
                {/if}

            </select>
            <br/>
        </p>

        <button type="reset" class="btn btn-danger">
            <span class="fa fa-eraser"> </span> Reset
        </button>

        <button type="submit" class="btn btn-primary">
            <span class="fa fa-save"> </span> Add
        </button>

        <a href="{$layoutParams.root}user/dict/" class="btn btn-danger"> <span class="fa fa-close"></span> Cancel</a>
        </form>
        </p>
    </div>
</div>