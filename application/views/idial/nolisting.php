<div class="container">

    <div class="row">
        <div class="span12">
            <div class="breadcrumbs">
                <ul class="breadcrumb">
                    <li><a href="<?php print base_url();?>">Home</a> <span class="divider">/</span></li>
                    <li class="active"><?php print $catName;?> </li>
                </ul>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="span12">
            <h1 class="page"><?php print $catName;?> </h1>
        </div>
    </div>
    <hr>
    <div class="row ">

        <div class="span12">
            <h2> <span style="color: red"><?php print $catName;?> </span> : There's no product listing for this category.</h2>
            <h6 class="e404">We are sorry, but the category you are looking for is empty.</h6>
            <p>
                <a class="btn btn-primary" href="<?php print base_url();?>">
                    Get me back to homepage!
                </a>
            </p>
        </div>
    </div>

</div>