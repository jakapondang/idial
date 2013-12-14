<div class="container">

    <div class="row">
        <div class="span12">
            <div class="breadcrumbs">
                <ul class="breadcrumb">
                    <li><a href="<?php print base_url()?>">HOME</a> <span class="divider">/</span></li>
                    <li class="active">Price list</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="span12">
            <h1 class="page">PRICE LIST</h1>
        </div>
    </div>
<?php //print_r($category);?>
    <div class="row">

                <?php
                for($i=0;$i<count($catAva);$i++){

                ?>
                    <div class="span6" style="padding-top:10px ">
                        <div class="contact_form" style="border:0px solid #762B90 !important;">
                            <h3><?php print $catName[$catAva[$i]];?></h3>

                            <table class="table" >
                                <?php
                                foreach($productList[$i] AS $row){
                                    if($catAva[$i]==$row->catid){
                                ?>
                                <tr>
                                    <td style="width:auto !important;"><a class="priceList" href="<?php print base_url().strtolower(str_replace(" ","-",urldecode($row->name)))?>/?i=<?php print $row->proid;?>"><?php print $row->name?></a></td>
                                    <td >
                                        <?php
                                            if($row->stock>0){
                                               ?>
                                                <span style="color:#762B90;font-size: 14px;">
                                                Rp. <?php    print number_format($row->price,0, '', '.');?>
                                                </span>
                                            <?php
                                            }else{
                                                ?>
                                                <span style="color:red;">
                                                <?php    print "Out of stock";?>
                                                </span>
                                            <?php
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                            </table>
                        </div>
                    </div>

                <?php
                    if (fmod($i,2)) {
                        print "<br clear='all'/>";
                    }
                }

                ?>




    </div>


    <br/>
    <br/>

</div>