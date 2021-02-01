<?php
    if(!empty($prod)){
        // var_dump($prod);
        foreach ($prod as $key => $value) {
            ?><tr>

                <td><span style="color:black; font-weight:bold;"><?=@$key + 1?></span>. <?=@$value->product_name?></td>
                <td><?=@$value->product_category_name?></td>
                <td><?=@$value->unit_name?></td>
                <td>
                    <span style="font-size:18px;" id="qty-<?=@$value->ID?>"><?=@(!empty($value->qty))?$value->qty:0;?> </span>
                </td>
                <td><?=@$value->price?></td>
                <td>
                    <input type="checkbox" class="check-input is_active" data-value="<?=@$value->auth_token;?>" <?=@(!empty($value->is_active))?'checked':'';?> style="width:17px; height:17px;">
                    <span id="label_is_active_<?=@$value->auth_token;?>"><?=@(!empty($value->is_active))?'Available':'Out of Stock';?></span>
                </td>
                <td><?=date('M d, Y - h:i:A', strtotime(@$value->datetime_last_update))?></td>
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