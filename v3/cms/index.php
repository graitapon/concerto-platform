<?php
/*
  Concerto Platform - Online Adaptive Testing Platform
  Copyright (C) 2011-2012, The Psychometrics Centre, Cambridge University

  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; version 2
  of the License, and not any of the later versions.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

if (!isset($ini)) {
    require_once'../Ini.php';
    $ini = new Ini();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="" />
        <meta name="author" content="Przemyslaw Lis" />
        <meta http-equiv="Cache-Control" content="no-cache"/>
        <meta http-equiv="Expires" content="-1"/>
        <title>Concerto Platform</title>
        <link rel="stylesheet" href="css/styles.css" />

        <link rel="stylesheet" href="js/lib/loadmask/jquery.loadmask.css" />
        <link rel="stylesheet" href="js/lib/selectmenu/jquery.ui.selectmenu.css" />
        <link rel="stylesheet" href="js/lib/tooltip/jquery.ui.tooltip.min.css" />
        <link rel="stylesheet" href="js/lib/kendo-ui/styles/kendo.common.css" />
        <link rel="stylesheet" href="js/lib/kendo-ui/styles/kendo.default.css" />
        <link rel="stylesheet" href="lib/CodeMirror/lib/codemirror.css" />
        <link rel="stylesheet" href="lib/CodeMirror/theme/night.css" />

        <script type="text/javascript" src="js/lib/jquery-1.8.0.min.js"></script>
        <script type="text/javascript" src="js/lib/jquery-ui-1.8.22.custom.min.js"></script>
        <script type="text/javascript" src="js/lib/tooltip/jquery.ui.widget.js"></script>
        <script type="text/javascript" src="js/lib/tooltip/jquery.ui.tooltip.js"></script>
        <script type="text/javascript" src="js/lib/selectmenu/jquery.ui.selectmenu.js"></script>
        <script type="text/javascript" src="js/lib/jquery.json-2.3.min.js"></script>
        <script type="text/javascript" src="js/lib/loadmask/jquery.loadmask.min.js"></script>
        <script type="text/javascript" src="js/lib/jsSHA/src/sha512.js"></script>

        <script src="../js/ConcertoMethods.js"></script>
        <script src="../js/Concerto.js"></script>

        <script src="js/OModule.js"></script>
        <script src="js/Methods.js"></script>
        <script src="js/User.js"></script>
        <script src="js/UserGroup.js"></script>
        <script src="js/UserType.js"></script>
        <script src="js/Template.js"></script>
        <script src="js/Table.js"></script>
        <script src="js/Test.js"></script>
        <script src="js/CustomSection.js"></script>
        <script src="js/QTIAssessmentItem.js"></script>
        <script src="lib/ckeditor/ckeditor.js"></script>
        <script src="lib/ckeditor/adapters/jquery.js"></script>
        <script src="lib/CodeMirror/lib/codemirror.js"></script>
        <script src="lib/CodeMirror/mode/htmlmixed/htmlmixed.js"></script>
        <script src="lib/CodeMirror/mode/r/r.js"></script>
        <script src="lib/CodeMirror/mode/xml/xml.js"></script>
        <script src="lib/CodeMirror/mode/javascript/javascript.js"></script>
        <script src="lib/CodeMirror/mode/css/css.js"></script>
        <script src="js/lib/jquery-ui-dialog-ckeditor-patch.js"></script>
        <script src="js/lib/fileupload/jquery.iframe-transport.js"></script>
        <script src="js/lib/fileupload/jquery.fileupload.js"></script>
        <script src="js/lib/themeswitcher/jquery.themeswitcher.min.js"></script>
        <script src="lib/jfeed/build/dist/jquery.jfeed.js"></script>

        <script>User.sessionID='<?= session_id(); ?>';</script>
        <?= Language::load_js_dictionary() ?>
        <script type="text/javascript" src="js/lib/kendo-ui/kendo.all.min.js"></script>
        <script type="text/javascript" src="js/lib/kendo-ui/cultures/kendo.culture.<?= Language::get_kendo_culture() ?>.min.js"></script>
        <script type="text/javascript">
            kendo.culture("<?= Language::get_kendo_culture() ?>");
        </script>
    </head>
    <body>
        <div id="content" align="center">
            <?php
            if (User::get_logged_user() == null) {
                include 'view/log_in.php';
            } else {
                include 'view/layout.php';
            }
            ?>
        </div>

        <div id="divLoadingDialog" class="notVisible"></div>
        <div id="divProgressDialog" class="notVisible">
            <div id="divProgressBar" class="fullWidth"></div>
        </div>
        <div id="divGeneralDialog" class="notVisible"></div>
        <div id="divAddFormDialog" class="notVisible"></div>

        <script>
            //password recovery
<?php
if (array_key_exists("pruid", $_GET) && array_key_exists("pruh", $_GET)) {
    if (User::recover_password($_GET['pruid'], $_GET['pruh'])) {
        ?>
                    $(function(){
                        Methods.alert(dictionary["s431"], "info", dictionary["s427"]);
                    });
        <?php
    } else {
        
    }
}
?>
        </script>
    </body>
</html>