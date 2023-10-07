<?php
define("ROOTPATH", dirname(dirname(dirname(__DIR__))));
define("APPPATH", ROOTPATH."/php/");
require_once ROOTPATH . '/includes/autoload.php';
require_once ROOTPATH . '/includes/lang/lang_'.$config['lang'].'.php';
admin_session_start();
$pdo = ORM::get_db();

if(isset($_GET['code'])){
    $info = ORM::for_table($config['db']['pre'].'countries')
        ->where('code',$_GET['code'])
        ->find_one();
}else{
    exit('Error: 404 Page not found');
}
?>

<header class="slidePanel-header overlay">
    <div class="overlay-panel overlay-background vertical-align">
        <div class="service-heading">
            <h2>Edit Country - <?php echo $info['name']; ?></h2>
        </div>
        <div class="slidePanel-actions">
            <div class="btn-group-flat">
                <button type="button" class="btn btn-floating btn-warning btn-sm waves-effect waves-float waves-light margin-right-10" id="post_sidePanel_data"><i class="icon ion-android-done" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-pure btn-inverse slidePanel-close icon ion-android-close font-size-20" aria-hidden="true"></button>
            </div>
        </div>
    </div>
</header>
<div class="slidePanel-inner">
    <div class="panel-body">
        <!-- /.row -->
        <div class="row">
            <div class="col-sm-12">

                <div class="white-box">
                    <div id="post_error"></div>
                    <form name="form2"  class="form form-horizontal" method="post" data-ajax-action="editCountry" id="sidePanel_form">
                        <div class="form-body">
                            <input type="hidden" name="code" value="<?php echo $_GET['code']?>">
                            <!-- text input -->
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Country Code</label>
                                <div class="col-sm-6">
                                    <input type="text" name="code" placeholder="Enter the country code (ISO Code)" class="form-control" value="<?php echo $info['code']; ?>" required>
                                </div>
                            </div>
                            <!-- text input -->
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Local Name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="name" placeholder="Local Name" class="form-control" value="<?php echo $info['name']; ?>" required>
                                </div>
                            </div>

                            <!-- text input -->
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="asciiname" placeholder="Enter the country name (In English)" class="form-control" value="<?php echo $info['asciiname']; ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Currency Code</label>
                                <div class="col-sm-6">
                                    <select name="currency_code" class="form-control" required>
                                        <option>-</option>
                                        <?php
                                        $currency = get_currency_list($info['currency_code']);
                                        foreach ($currency as $value) {
                                            $code = $value['code'];
                                            $selected = $value['selected'];
                                            echo '<option value="'.$code.'" '.$selected.'>'.$code.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- text input -->
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Phone Code. (Optional)</label>
                                <div class="col-sm-6">
                                    <input type="text" name="phone" placeholder="Enter the country phone ind. (E.g. +229 for Benin)" class="form-control" value="<?php echo $info['phone']; ?>">
                                </div>
                            </div>
                            <!-- text input -->
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Languages</label>
                                <div class="col-sm-6">
                                    <input type="text" name="languages" placeholder="Enter the locale code (ISO) separate with comma" class="form-control" value="<?php echo $info['languages']; ?>">
                                </div>
                            </div>
                            <div class="form-group image hidden" data-preview="#background_image" data-aspectratio="0" data-crop="">
                                <label class="col-sm-4 control-label">Background Image <code>Homepage background image for this country.</code></label>
                                <div class="col-sm-6" style="margin-top: 10px;">
                                    <img src="" id="home-bg-src" width="200px" />
                                    <div class="btn-group">
                                        <label class="btn btn-primary btn-file">
                                            Choose file <input type="file" name="file" onchange="readURL(this,'home-bg-src')">
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <input type="hidden" name="submit">

                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
</div>