<div class="well well-md text-center">
<form id="form1" class="form-inline">
    Number :
    <input type="text" name="number" id="number" class="form-control-static"/>
    <button type="button" id="btnSearch" class="btn btn-primary">
        <span class="glyphicon glyphicon-search"></span>
    </button>
    <br/>
    <br/>
    Pais:
    <select id="pais" class="form-control-static">
        <option value="">
            Select Pais
        </option>
        {foreach from = $paises  item = ps}
            <option value="{$ps.id}">
                {$ps.pais}
            </option>
        {/foreach}
    </select>
&nbsp;
    Ciudad:
    <select id="ciudad" class="form-control-static">
        <option value=""> Select One </option>
    </select>
</form>
</div>

<div id="list">

    {if isset($pureba) && count($pureba)}
        <table class="table table-striped table-hover">
            <thead>
            <tr class="success text-center">
                <td> #</td>
                <td> Number</td>
                <td> Pais</td>
                <td> Ciudad </td>

            </thead>

            {foreach from = $pureba item = pu }
                <tr>
                    <td align="center"> {$pu.id}      </td>
                    <td align="center"> {$pu.number}    </td>
                    <td align="center"> {$pu.pais}    </td>
                    <td align="center"> {$pu.ciudad}    </td>
                </tr>
            {/foreach}

            <tr class="success text-center">
                <td> #</td>
                <td> Number</td>
                <td> Pais</td>
                <td> Ciudad </td>
            </tr>
        </table>
    {else}
        <p><strong> No page exists.</strong></p>
    {/if}
    {$pagination|default:''}

</div>


