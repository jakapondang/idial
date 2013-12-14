<div class="container">

    <div class="row">
        <div class="span12">
            <div class="breadcrumbs">
                <ul class="breadcrumb">
                    <li><a href="index-2.html">Home</a> <span class="divider">/</span></li>
                    <li class="active">Search</li>
                </ul>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="span12">
           <!-- <h1 class="page-title">Search</h1>-->
            <h2 class="page">Looking for <span color="#762B90"><?php print $ksearch;?> ..</span></h2>
        </div>
    </div>

    <br clear="all"/>
    <div class="row">
        <form method="get" action="<?php print base_url();?>search/" name="searchForm">
        <div class="span3">

           <input type="text" name="s" placeholder="Search Keyword" value="<?php print $ksearch;?>" style=""/>

        </div>
       <div class="span3">
           <button class="btn btn-primary" type="submit">Search</button>

       </div>
       </form>
        <br>
        <br clear="all"/>
        <div class="span12">
            <?php print $productList;?>
        </div>
    </div>

</div>