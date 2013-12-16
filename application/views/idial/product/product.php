<div class="container">
    <ul class="breadcrumb">
        <li><a href="<?php print base_url()?>">Home</a> <span class="divider">/</span></li>
        <li class="active"><?php print $pro_name;?></li>

    </ul>

    <div class="row product-info">
        <div class="span6">
            <?php
            if(!empty($imageProduct)){
                print '<div class="image"><a class="cloud-zoom" rel="adjustX: 0, adjustY:0" id="zoom1" href="'.$mbaseurl.'upload/product/'.$fimage.'" title="'.$pro_name.'"><img src="'.$mbaseurl.'upload/product/'.$fimage.'" title="'.$pro_name.'" alt="'.$pro_name.'" id="image" /></a></div>';
                ?>
                <div class="image-additional">
                <?php
                for($i=0;$i<count($imageProduct);$i++){
                    ?>
                        <a title="Dress" rel="useZoom: 'zoom1', smallImage: '<?php print $mbaseurl.'upload/product/thmb/'.$imageProduct[$i];?>'" class="cloud-zoom-gallery" href="<?php print $mbaseurl.'upload/product/'.$imageProduct[$i];?>">
                            <img alt="<?php print $pro_name?>" title="<?php print $pro_name?>" src="<?php print $mbaseurl.'upload/product/thmb/'.$imageProduct[$i];?>"></a>
                    <?php
                }
                ?>
                </div>
                <?php
            }

              ?>



        </div>
        <div class="span6">
            <h1><?php print $pro_name;?></h1>
            <div class="line"></div>
            <ul>
                <li> <a href="#"><h3 style="color: #762B90"> <?php print $nameB?></h3></a></li>
                <li><span>Product Code:</span> <?php print $sku;?></li>
                <!--<li><span>Availability: </span>In Stock</li>-->
            </ul>
            <div class="price">
                Price <!--<span class="strike">$150.00</span>--> <strong>Rp.<?php print number_format($gross,0,"",".");?></strong>
            </div>
           <!-- <span class="price-tax">Ex Tax: $400.00</span>-->

            <div class="line"></div>
            <form class="form-inline">
                <b>Qty:</b> <input style="width: 50px !important;" type="text" placeholder="1" value="" class="span1">

                <!--<button style="float: right" class="btn btn-primary" type="button">Add to Cart</button>-->
                <a href="<?php print base_url();?>contact"><button style="float: right" class="btn btn-primary" type="button">BUY @ iDial</button></a>
            </form>

        </div>
    </div>

<br clear='all'/>
    <div class="span12">
         <div class="tabs">
             <ul class="nav nav-tabs" id="myTab">
                 <li class="active"><a href="#home">Description</a></li>
                 <li><a href="#profile">Specification</a></li>
                 <!-- <li><a href="#messages">Reviews</a></li>-->
             </ul>
             <div class="tab-content">
                 <div class="tab-pane active" id="home">
                     <?php print htmlspecialchars_decode($sdesc);?>
                 </div>
                 <div class="tab-pane" id="profile">
                     <?php print htmlspecialchars_decode($desc);?>

                 </div>
                 <div class="tab-pane" id="messages">
                     <p>There are no reviews yet, would you like to <a href="#review_btn">submit yours?</a></p>
                     <h3>Be the first to review “Blue Dress” </h3>
                     <form>
                         <fieldset>
                             <label>Name<span class="required">*</span></label>
                             <input type="text" placeholder="Name">
                             <label>Email<span class="required">*</span></label>
                             <input type="text" placeholder="Email">
                             <label class="rating">Rating</label>
                             <img alt="rating" src="image/stars-5.png">
                         </fieldset>
                     </form>
                     <label>Your Review<span class="required">*</span></label>
                     <textarea rows="3"></textarea>
                     <p id="review_btn">
                         <button class="btn" type="button">Submit Review</button>
                     </p>
                 </div>
             </div>
         </div>
    </div>
    <br clear='all'/>
    <br/>
    <div class="row">
        <div class="span12">
            <h2 class="page"  style="border-left: 10px solid #762B90;padding-left:10px" >Checkout our other Products</h2>
        </div>
    </div>
    <?php print $relProduct;?>

</div>
<br clear='all'/>
<br/>

