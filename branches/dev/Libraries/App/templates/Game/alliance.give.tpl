{block name="title" prepend}{/block}
{block name="content"}
        <center>
            <br>
            <form method="post" action="game.php?page=alliance">
                <table width="600" border="0" cellpadding="0" cellspacing="1" ALIGN="center">
                    <tr>
                        <td class="c" colspan="4" align="center">
                            A qui voulez vous donner l alliance ?
                        </td>
                    </tr>
                    <tr>
                        <th colspan="3">
                            Choisissez le joueur a qui vous souhaitez donner l alliance :
                        </th>
                        <th colspan="1">
                            <SELECT NAME="id">{$select}</SELECT>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="4">
                            <INPUT TYPE="submit" VALUE="Donner">
                        </th>
                    </tr>
                </table>
            </form>
        </center>
{/block}