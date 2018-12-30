<?=examDashboard()?>
<a name="" id="" class="btn btn-secondary float-right btn-sm border mx-md-3" href="<?=base_url('exams/config')?>" role="button"><i class="fa fa-cogs"></i>    Config</a>
<h5>Exams Registered</h5>
<?php activeModules($active,$modules,"exams") ?>
<hr>

<?php 
$enrol_url = base_url('school/exams/enrol');
$f = new Tablo('exams');

$f->sqlstring = "select  ucase(concat(e.name, ' \(',  e.abbr,  '\)' ) ) as exam, e.*,
                    concat('<a href=\"$enrol_url/', e.id, '\" class=\"btn btn-secondary btn-sm pull-right\">ENROL STUDENTS</a>') as _
                    from exams e ";

// $f->hide('year,term,abbr,name');
// $f->where('year = '.date('Y'));
$f->combos('counts', ['1'=>'YES','2'=>'NO']);
$f->table(0);