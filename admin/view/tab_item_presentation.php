<!--
    Concerto Testing Platform,
    Web based adaptive testing platform utilizing R language for computing purposes.

    Copyright (C) 2011  Psychometrics Centre, Cambridge University

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
-->

<script>
    $(function(){
        Methods.iniIconButtons(); 
    });
</script>

<?php
if (!isset($ini))
{
    require_once '../../model/Ini.php';
    $ini = new Ini();
}
$user = User::get_logged_user();
if ($user == null) die(Language::string(85));

$oid = isset($_POST['oid']) ? $_POST['oid'] : array();

$item = Item::from_mysql_id($oid);
if ($item == null) $item = new Item();
?>

<script>
    $(function(){
        Item.editor = Methods.iniCKEditor("#htmlEditor", "<?= Ini::$external_path ?>"); 
    });
</script>

<div class="ui-widget-content ui-corner-all fullWidth ui-state-focus noWrap" align="center">
    <button class="btnInfoItemTemplate"></button>
    <label><?= Language::string(4) ?></label>
    <select id="selectHTMLTemplate">
        <?php
        $sql = $user->mysql_list_rights_filter("Item", "`Item`.`name` ASC");
        $z = mysql_query($sql);
        while ($r = mysql_fetch_array($z))
        {
            $obj = Item::from_mysql_id($r[0]);
            ?>
            <option value="<?= $obj->id ?>">id: <?= $obj->id ?> - <?= $obj->name ?></option>
        <?php } ?>
    </select>
    <button class="btnImportHTML" onmouseup="Item.importHTML($('#selectHTMLTemplate').val())"></button>
</div>

<textarea id="htmlEditor" name="htmlEditor" ></textarea>

<div class="ui-widget-content ui-corner-all fullWidth ui-state-focus" style="">
    <table class="fullWidth formTable">
        <tr>
            <td class="noWrap">
                *<?= Language::string(50) ?>:
            </td>
            <td style="width:50%;">
                <input type="text" class="fullWidth" name="formItemInputName" id="formItemInputName" value="<?= $item->name ?>" />
            </td>
            
            <td rowspan="3" style="border-right:solid 1px black;"></td>

            <td class="noWrap">
                <?= Language::string(105) ?>:
            </td>
            <td style="width:50%;">
                <select id="formItemSelectSharing" class="fullWidth">
                    <?php foreach (DS_Sharing::get_all() as $share)
                    { ?>
                        <option value="<?= $share->id ?>" <?= ($share->id == $obj->Sharing_id ? "selected" : "") ?>><?= $share->name ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        
        <tr>
            <td class="noWrap">
                <?= Language::string(51) ?>:
            </td>
            <td>
                <input type="text" id="formItemInputHash" name="formItemInputHash" value="<?= $item->hash ?>" readonly class="fullWidth" />
            </td>

            <td class="noWrap">
                <button class="btnInfoItemDefaultButton"></button>
                <?= Language::string(59) ?>:
            </td>
            <td class="noWrap" id="tdDefaultButton">
                <?php include Ini::$internal_path . "admin/view/tab_item_presentation_default.php"; ?>
            </td>
        </tr>
        
        <tr>
            <td class="noWrap">
                <button class="btnInfoItemTimer"></button>
                <?= Language::string(6) ?>
            </td>
            <td>
                <input type="text" id="formItemInputTimer" name="formItemInputTimer" value="<?= $item->timer ?>" class="fullWidth" />
            </td>
            <td></td>
            <td></td>
        </tr>
    </table>
</div>