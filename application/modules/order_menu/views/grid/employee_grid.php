<?php
    if(!empty($data)){
        // var_dump($data);
        foreach ($data as $key => $value) {
            ?><tr>

                <td><span style="color:black; font-weight:bold;"><?=@$key + 1?></span>. <?=@$value->employee_no?></td>
                <td><?=@$value->picture?></td>
                <td><?=@$value->first_name.' '.@$value->middle_name.' '.@$value->last_name?></td>
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