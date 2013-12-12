<div class="container">

    <div class="row">
        <div class="span12">
            <div class="breadcrumbs">
                <ul class="breadcrumb">
                    <li><a href="<?php print base_url();?>">HOME</a> <span class="divider">/</span></li>
                    <li class="active">Contact Us</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="span12">
            <h2>Contact Us</h2>
        </div>
    </div>
    <div class="row">
        <div class="span12">
            <div id="map">
                <p>Enable your JavaScript!</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="span6">
            <div class="contact_form">
                <h3>Contact Us</h3>
                <form>
                    <fieldset>
                        <span class="required">*</span>
                        <input type="text" placeholder="Name">
                        <span class="required">*</span>
                        <input type="text" placeholder="Email">
                        <span class="required">*</span>
                        <input type="text" placeholder="Subject">
                    </fieldset>
                </form>
                <label>Message<span class="required">*</span></label>
                <textarea rows="3"></textarea>
                <p>
                    <button class="btn" type="button">Send Request</button>
                </p>
            </div>
        </div>
        <div class="span6">
            <div class="location">
                <h3>iDial info</h3>
                <span class="address">Address:</span>

                <?php print $main_store;?>

            </div>
        </div>
    </div>

</div>