<?php
    if(!empty($prod)){
        // var_dump($prod);
        foreach ($prod as $key => $value) {
            ?><tr>

                <td><span style="color:black; font-weight:bold;"><?=@$key + 1?></span>. <?=@$value->product_name?></td>
                <td><?=@$value->product_category_name?></td>
                <td><?=@$value->unit_name?></td>
                <td>
                    <button class="btn btn-danger btn-sm deduct-stock" data-value="<?=@$value->ID;?>" ><i class="fa fa-minus"></i></button>
                        &nbsp;
                        <span style="font-size:18px;" id="qty-<?=@$value->ID?>"><?=@(!empty($value->qty))?$value->qty:0;?> </span>
                        &nbsp;
                    <button class="btn btn-success btn-sm add-stock" data-value="<?=@$value->ID;?>" ><i class="fa fa-plus"></i></button>
                </td>
                <td><?=@$value->price?></td>
                <td><?=date('M d, Y - h:i:A', strtotime(@$value->datetime_created))?></td>
                <td><?=date('M d, Y - h:i:A', strtotime(@$value->datetime_last_update))?></td>
                <!-- <td><a href="<?php echo base_url()?>product-mngnt/update?token=<?=@$value->auth_token?>"><button class="btn btn-primary btn-sm">OPEN</button></a></td> -->
            </tr><?php
        }
    }else{
        ?><tr>
            <td colspan="3"><div>
                <h5 style="color:red">No Data Found.</h5>
            </div></td>
        </tr><?php
    }
?>