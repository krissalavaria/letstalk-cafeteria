<?php
    if(!empty($prod)){
        foreach ($prod as $key => $value) {
            ?><tr>

                <td><span style="color:black; font-weight:bold;"><?=@$key + 1?></span>. <?=@$value->product_name?></td>
                <td><?=@$value->product_category_name?></td>
                <td><?=@$value->unit_name?></td>
                <td><b style="font-size:18px;"><?=@(!empty($value->qty))?$value->qty:0;?></b> </td>
                <td><?=@$value->price?></td>
                <td><?=date('M d, Y - h:i:A', strtotime(@$value->datetime_created))?></td>
                <td><a href="<?php echo base_url()?>product-mngmt/update?token=<?=@$value->auth_token?>"><button class="btn btn-primary btn-sm">OPEN</button></a></td>
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