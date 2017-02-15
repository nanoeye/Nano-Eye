{if isset($pureba) && count($pureba)}
    <table class="table table-striped table-hover">
        <thead>
        <tr align="center" class="success">
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

        <tr align="center" class="success">
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