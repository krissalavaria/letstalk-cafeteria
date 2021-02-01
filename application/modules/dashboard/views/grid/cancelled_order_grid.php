<?php
    if(!empty($data)){

        foreach ($data as $key => $value) {
            ?>
            <tr>
            <td><span style="color:red; font-weight:bold;"><?=@$value->order_no?></span> </td>
                <td><?=@ucfirst($value->first_name)[0].'. '.@$value->last_name?></td>
                <td><a href="<?php echo base_url()?>dashboard/open-order?order-no=<?=@$value->order_no?>"><button class="btn btn-primary btn-sm">OPEN</button></a></td> 
            </tr>
            <?php
        }

    }else{
        ?><tr>
            <td colspan="3"><div>
                <h5 style="color:red">No Data Found.</h5>
            </div></td>
        </tr><?php
    }
?>