<div class="title" align="center"> 
    Ajax data Uploader
</div>

<BR/>

<form>
    <span class="input-group">
        <span class="input-group-addon">
            Pais:</span>
        <select id="pais" class="form-control">
            <option value=""> Select one </option>
            {foreach from = $paises item = p}

                <option value = "{$p.id}"> {$p.pais} </option>

            {/foreach}
        </select>
    </span>

    <br/>

    <span class="input-group">
        <span class="input-group-addon">
            Ciudad:</span>
        <select id="ciudad" class="form-control">
        </select>
    </span>

    <br/>

    <span class="input-group">
        <span class="input-group-addon">
            Ciudad a Insert:</span>
        <input type="text" id="ins_ciudad" class="form-control"/>
    </span>
    <input class="btn btn-primary" type="button" value="Upload" id="btn_insert"/>
</form>
