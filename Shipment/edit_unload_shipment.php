<?php
$main_page = "Local shipment";
$page = "Edit unload shipment";
include './file_includes.php';
if ($_SESSION['shipment_user']) {
    $login_user = $_SESSION['shipment_user'];
    if ($_GET['ship_id']) {
        $ship_id = $_GET['ship_id'];
        $manifestSQL = "SELECT * FROM unload_shipment WHERE id='$ship_id'";
        $manifest_fetch = json_decode(ret_json_str($manifestSQL));
        foreach ($manifest_fetch as $manifest_val) {
            $manifest_no = $manifest_val->manifest_no;
            $manifest_date = $manifest_val->manifest_date;
            $despatch_from = $manifest_val->despatch_from;
            $despatch_to = $manifest_val->despatch_to;
            $lorry_no = $manifest_val->lorry_no;
            $driver_code = $manifest_val->driver_code;
            $unload_date = $manifest_val->unload_date;
        }
        ?>﻿
        <!DOCTYPE html>
        <html>
            <head>
                <?php
                include './header_links.php';
                ?>
            </head>

            <body class="theme-red">
                <?php
                include './menu.php';
                ?>

                <section class="content">
                    <div class="container-fluid">
                        <div class="block-header">
                            <h2>EDIT UNLOAD SHIPMENT</h2>
                        </div>
                        <!-- Input -->
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="body">
                                        <b class="text-success" id="success_message" style="font-size: 18px;"></b>
                                        <b class="text-danger" id="error_message" style="font-size: 18px;"></b>
                                        <div class="row clearfix">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>MANIFEST NO</label><span class="text-danger"> *</span>
                                                    <div class="form-line">
                                                        <input type="text" tabindex="1" class="form-control" name="manifest_no" id="manifest_no" placeholder="ENTER MANIFEST NO" value="<?php echo $manifest_no; ?>" />
                                                        <input type="hidden" class="form-control" name="hmanifest_no" id="hmanifest_no" placeholder="ENTER MANIFEST NO" value="<?php echo $manifest_no; ?>" />
                                                    </div>
                                                    <b class="text-danger" id="manifest_noErr"></b>
                                                </div>
                                                <div class="form-group">
                                                    <label>MANIFEST DATE</label><span class="text-danger"> *</span>
                                                    <div class="form-line">
                                                        <input type="date" tabindex="3" class="form-control" name="manifest_date" id="manifest_date" placeholder="ENTER MANIFEST DATE" value="<?php echo $manifest_date; ?>"/>
                                                    </div>
                                                    <b class="text-danger" id="manifest_dateErr"></b>
                                                </div>
                                                <div class="form-group">
                                                    <label>DESPATCH FROM</label><span class="text-danger"> *</span>
                                                    <div class="form-line">
                                                        <input type="text" tabindex="5" class="form-control" name="despatch_from" id="despatch_from" placeholder="ENTER DESPATCH FROM" value="<?php echo $despatch_from; ?>"/>
                                                    </div>
                                                    <b class="text-danger" id="despatch_fromErr"></b>
                                                </div>
                                                <div class="form-group">
                                                    <label>DRIVER CODE/NAME</label><span class="text-danger"> *</span>
                                                    <div class="form-line">
                                                        <input type="text" tabindex="7" class="form-control" name="driver_no_name" id="driver_no_name" placeholder="ENTER DRIVER CODE/NAME" value="<?php echo $driver_code; ?>"/>
                                                    </div>
                                                    <b class="text-danger" id="driver_noErr"></b>
                                                </div>
                                                <div class="form-group">
                                                    <button type="button" tabindex="8" name="edit_unload_shipment" id="edit_unload_shipment" class="btn btn-primary" onclick="edit_unload_shipment();">
                                                        SAVE
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                <label>LORRY NO</label><span class="text-danger"> *</span>
                                                <div class="form-line">
                                                    <input type="text" tabindex="2" class="form-control" name="lorry_no" id="lorry_no" placeholder="ENTER LORRY NO" value="<?php echo $lorry_no; ?>"/>
                                                </div>
                                                <b class="text-danger" id="lorry_noErr"></b>
                                            </div>
                                                <div class="form-group">
                                                    <label>UNLOAD DATE</label><span class="text-danger"> *</span>
                                                    <div class="form-line">
                                                        <input type="date" tabindex="4" class="form-control" name="unload_date" id="unload_date" placeholder="ENTER UNLOAD DATE" value="<?php echo $unload_date; ?>"/>
                                                    </div>
                                                    <b class="text-danger" id="unload_dateErr"></b>
                                                </div>
                                                <div class="form-group">
                                                    <label>DESPATCH TO</label><span class="text-danger"> *</span>
                                                    <div class="form-line">
                                                        <input type="text" tabindex="6" class="form-control" name="despatch_to" id="despatch_to" placeholder="ENTER DESPATCH TO" value="<?php echo $despatch_to; ?>"/>
                                                    </div>
                                                    <b class="text-danger" id="despatch_toErr"></b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- #END# Input -->

                    </div>
                </section>
                <?php
                include './footer_links.php';
                ?>
                <script>
                    function edit_unload_shipment() {
                        var login_user = "<?php echo $login_user; ?>";
                        var ship_id = "<?php echo $ship_id; ?>";
                        var manifest_no = $("#manifest_no").val().trim();
                        var hmanifest_no = $("#hmanifest_no").val().trim();
                        var despatch_from = $("#despatch_from").val().trim();
                        var lorry_no = $("#lorry_no").val().trim();
                        var manifest_date = $("#manifest_date").val().trim();
                        var unload_date = $("#unload_date").val().trim();
                        var despatch_to = $("#despatch_to").val().trim();
                        var driver_no_name = $("#driver_no_name").val().trim();
                        if ((manifest_no === "") || (unload_date === "") || (despatch_from === "") || (lorry_no === "") || (manifest_date === "") || (driver_no_name === "") || (despatch_to === "")) {
                            $("#error_message").html("Provide all the fields<br/><br/>");
                            $('#manifest_noErr').text("Required");
                            $('#despatch_fromErr').text("Required");
                            $('#lorry_noErr').text("Required");
                            $('#manifest_dateErr').text("Required");
                            $('#despatch_toErr').text("Required");
                            $('#driver_noErr').text("Required");
                            $('#unload_dateErr').text("Required");
                        } else {
                            $.ajax({
                                type: "POST",
                                url: "getAPI.php?edit_unload_shipment",
                                dataType: "json",
                                data: {
                                    ship_id: ship_id,
                                    login_user: login_user,
                                    manifest_no: manifest_no,
                                    hmanifest_no: hmanifest_no,
                                    despatch_from: despatch_from,
                                    lorry_no: lorry_no,
                                    manifest_date: manifest_date,
                                    despatch_to: despatch_to,
                                    driver_no_name: driver_no_name,
                                    unload_date: unload_date
                                },
                                success: function (RetVal) {
                                    if (RetVal.message === "Success") {
                                        $("#success_message").html(RetVal.data + "<br/><br/>");
                                        $("#error_message").text("");
                                        $('#manifest_noErr').text("");
                                        $('#despatch_fromErr').text("");
                                        $('#lorry_noErr').text("");
                                        $('#manifest_dateErr').text("");
                                        $('#despatch_toErr').text("");
                                        $('#driver_noErr').text("");
                                        $('#unload_dateErr').text("");
                                    } else {
                                        $("#error_message").html(RetVal.message + "<br/><br/>");
                                        $("#success_message").text("");
                                        var driver_noErr = JSON.parse(RetVal.data).Driver_noErr;
                                        var manifest_noErr = JSON.parse(RetVal.data).Manifest_noErr;
                                        var despatch_fromErr = JSON.parse(RetVal.data).Despatch_fromErr;
                                        var lorry_noErr = JSON.parse(RetVal.data).Lorry_noErr;
                                        var manifest_dateErr = JSON.parse(RetVal.data).Manifest_dateErr;
                                        var despatch_toErr = JSON.parse(RetVal.data).Despatch_toErr;
                                        var unload_dateErr = JSON.parse(RetVal.data).Unload_dateErr;
                                        if (despatch_fromErr === null) {
                                            despatch_fromErr = "";
                                        }
                                        if (driver_noErr === null) {
                                            driver_noErr = "";
                                        }
                                        if (unload_dateErr === null) {
                                            unload_dateErr = "";
                                        }
                                        if (manifest_noErr === null) {
                                            manifest_noErr = "";
                                        }
                                        if (lorry_noErr === null) {
                                            lorry_noErr = "";
                                        }
                                        if (manifest_dateErr === null) {
                                            manifest_dateErr = "";
                                        }
                                        if (despatch_toErr === null) {
                                            despatch_toErr = "";
                                        }
                                        $('#manifest_noErr').text("");
                                        $('#despatch_fromErr').text("");
                                        $('#lorry_noErr').text("");
                                        $('#manifest_dateErr').text("");
                                        $('#despatch_toErr').text("");
                                        $('#driver_noErr').text("");
                                        $('#unload_dateErr').text("");
                                        $('#manifest_noErr').text(manifest_noErr);
                                        $('#despatch_fromErr').text(despatch_fromErr);
                                        $('#lorry_noErr').text(lorry_noErr);
                                        $('#manifest_dateErr').text(manifest_dateErr);
                                        $('#despatch_toErr').text(despatch_toErr);
                                        $('#driver_noErr').text(driver_noErr);
                                        $('#unload_dateErr').text(unload_dateErr);
                                    }

                                }
                            });
                        }
                    }
                </script>
            </body>
        </html>
        <?php
    }
} else {
    header("location:index.php");
}
?>