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
            <h1 class="page-title">Contact Us</h1>
        </div>
    </div><!---->
    <div class="row">
        <div class="span6">

            <div class="contact_form" <?php print $form_contact_align;?>>
               
             	<?php print $form_contact;?>
            </div>
        </div>
        <div class="span6">
            <div class="location" style="text-align: center">
                <h3>iDial info</h3>
                <span class="address">Address:</span>

                <?php print $main_add;?>
				  <br/>
            </div>
        </div>
    </div>
    <br clear="all"/>
    <br/>
    <div class="row">
        <div class="span12">
            <div id="map">
                <p>Enable your JavaScript!</p>
            </div>
        </div>
    </div>

    

</div>
