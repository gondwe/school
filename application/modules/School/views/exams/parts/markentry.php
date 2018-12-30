<?php 

// pf(current($data));

?>

<table class="w-auto table-striped">
    <thead>
        <tr>
            <th  class="text-center">Reg No</th>
            <th>Names</th>
            <th class='text-center mx-md-4'>Mark</th>
        </tr>
    </thead>
    <tbody>
    
    <?php foreach ($data as $key => $values): ?>
        <tr>
            <td class="text-center"><?=$values->adm_no?></td>
            <td><?=$values->name?></td>
            <td>
                <input style='width:30px' class='text-center marks mx-md-4' id="<?=$values->adm_no?>" type="text" data-id="<?=$values->id?>" value="<?=$values->marks?>">
            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>


<script>
    const limit = <?=$exam->outof?>;
    const saveMarkEntry = "<?=base_url('Exams/saveMarkEntry/')?>"
    $('.marks').blur(function(){
        
        
        var mark = $(this).val();
        if(mark != ''){ 
        
        // check mark limit
        if(mark > limit ){
            $(this).val("")
            alert('This exam is out of ' + limit, "Limit Exceeded");
            $(this).focus()
            
        }else{


                //save the value to db
                var sub = <?=$sub?>;
                var id = $(this).data('id');
                
                $.post(saveMarkEntry + id + '/' + sub + '/' + mark );
                
                
            }

        }

    })
</script>

<?php 
