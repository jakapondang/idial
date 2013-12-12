<div class="container">

    <div class="row">
        <div class="span12">
            <div class="breadcrumbs">
                <ul class="breadcrumb">
                    <li><a href="<?php print base_url();?>">Home</a> <span class="divider">/</span></li>

                    <li class="active"><?php print $category;?></li>
                </ul>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="span12">
            <div class="cat_header">
                <h2><?php print $category;?></h2>
            </div>

        </div>
    </div>
<?php print $product;?>
    <!--<div class="row">
        <div class="span12">
            <div class="pagination pagination-right">
                <ul>
                    <li><a href="#">«</a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="category2.html">2</a></li>
                    <li><a href="categry2.html">»</a></li>
                </ul>
            </div>
        </div>
    </div>-->

</div>