<?php 



$sublist = subjectList($subjects);

$codelist = array_keys($sublist);

$codes = implode('`,b.`',$codelist);

// pf($codelist);

$data = $this->db
                ->select('b.id, b.adm_no, s.name,b.`'.$codes.'`')
                ->where('b.exam_code',$exam->id)
                ->from('broadsheet b')
                ->join('students s', 's.adm_no = b.adm_no')
                ->get()
                ->result_array();


                // pf($data);

$titles = array_keys(current($data));

array_shift($titles);   // removes the name offset

?>

<table class="w-auto table-striped">
    <thead class="thead-inverse">
        <tr>
            <?php 
                
                array_map(function($th){

                    echo "<th class='text-center border-right'>".strtoupper($th)."</th>";

                },$titles);
                echo "<th>&nbsp</th>";
            ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach($data as $tbody): ?>
            <tr>
            <?php 
            $id = array_shift($tbody);
            
            $adm_no = array_shift($tbody);

            $names = array_shift($tbody);
            
            echo "<td class='text-center border-right'>$adm_no</td>";
            
            echo "<td class='px-md-3' >".strtoupper($names)."</td>";
            

                foreach($tbody as $tr=>$td): /* pf($tbody) */ ?>
                    
                    <td style='width:3px'>
                        
                        <input type="text" class='text-center marks' style="width:30px" data-subject='<?=$codelist[$tr]?>' value="<?=$td?>" data-id="<?=$id?>">

                    </td>

                <?php 
                    endforeach;
                    echo "<td></td>";
                 ?>
            </tr>

        <?php endforeach; ?>

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
                var sub = $(this).data('subject');
                var id = $(this).data('id');
                
                
                $.post(saveMarkEntry + id + '/' + sub + '/' + mark );
                    
            }

        }

    })
</script>