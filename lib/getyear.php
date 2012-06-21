<?php
require SIMBIO_BASE_DIR.'simbio_GUI/table/simbio_table.inc.php';
require SIMBIO_BASE_DIR.'simbio_GUI/paging/simbio_paging.inc.php';
require SIMBIO_BASE_DIR.'simbio_GUI/form_maker/simbio_form_element.inc.php';
require SIMBIO_BASE_DIR.'simbio_DB/datagrid/simbio_dbgrid.inc.php';

?>
    <!-- filter -->
    <fieldset style="margin-bottom: 3px;">
    <legend style="font-weight: bold"><?php echo strtoupper(__('Items Usage Statistics')); ?> - <?php echo __('Report Filter'); ?></legend>
    <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>" target="reportView">
    <div id="filterForm">
        <div class="divRow">
            <div class="divRowLabel"><?php echo __('Title/ISBN'); ?></div>
            <div class="divRowContent">
            <?php echo simbio_form_element::textField('text', 'title', '', 'style="width: 50%"'); ?>
            </div>
        </div>
        <div class="divRow">
            <div class="divRowLabel"><?php echo __('Item Code'); ?></div>
            <div class="divRowContent">
            <?php echo simbio_form_element::textField('text', 'itemCode', '', 'style="width: 50%"'); ?>
            </div>
        </div>
        <div class="divRow">
            <div class="divRowLabel"><?php echo __('Year'); ?></div>
            <div class="divRowContent">
            <?php
            $current_year = date('Y');
            $year_options = array();
            for ($y = $current_year; $y > 1999; $y--) {
                $year_options[] = array($y, $y);
            }
            echo simbio_form_element::selectList('year', $year_options, $current_year-1);
            ?>
            </div>
        </div>
    </div>
    <div style="padding-top: 10px; clear: both;">
    <input type="submit" name="applyFilter" value="<?php echo __('Apply Filter'); ?>" />
    <input type="hidden" name="reportView" value="true" />
    </div>
    </form>
    </fieldset>
    <!-- filter end -->
    <div class="dataListHeader" style="padding: 3px;"><span id="pagingBox"></span></div>
    <iframe name="reportView" id="reportView" src="<?php echo $_SERVER['PHP_SELF'].'?reportView=true'; ?>" frameborder="0" style="width: 100%; height: 500px;"></iframe>
<?php
} else {
    ob_start();
    // table spec
    $table_spec = 'coa AS c
        LEFT JOIN koperasi AS k ON c.idkoperasi=k.idkoperasi';

    // create datagrid
	$reportgrid = new simbio_datagrid();
//    $reportgrid = new report_datagrid();
    $reportgrid->setSQLColumn('k.nama AS \'Koperasi\'',
        '\'01\' AS \'Jan\'',
        '\'02\' AS \'Feb\'',
        '\'03\' AS \'Mar\'',
        '\'04\' AS \'Apr\'',
        '\'05\' AS \'May\'',
        '\'06\' AS \'Jun\'',
        '\'07\' AS \'Jul\'',
        '\'08\' AS \'Aug\'',
        '\'09\' AS \'Sep\'',
        '\'10\' AS \'Oct\'',
        '\'11\' AS \'Nov\'',
        '\'12\' AS \'Dec\''
        );
    $reportgrid->setSQLorder('k.nama ASC');

/**
    // is there any search
    $criteria = 'b.biblio_id IS NOT NULL ';
    if (isset($_GET['title']) AND !empty($_GET['title'])) {
        $keyword = $dbs->escape_string(trim($_GET['title']));
        $words = explode(' ', $keyword);
        if (count($words) > 1) {
            $concat_sql = ' AND (';
            foreach ($words as $word) {
                $concat_sql .= " (b.title LIKE '%$word%' OR b.isbn_issn LIKE '$word%') AND";
            }
            // remove the last AND
            $concat_sql = substr_replace($concat_sql, '', -3);
            $concat_sql .= ') ';
            $criteria .= $concat_sql;
        } else {
            $criteria .= ' AND (b.title LIKE \'%'.$keyword.'%\' OR b.isbn_issn LIKE \''.$keyword.'%\')';
        }
    }
    if (isset($_GET['itemCode']) AND !empty($_GET['itemCode'])) {
        $item_code = $dbs->escape_string(trim($_GET['itemCode']));
        $criteria .= ' AND (i.item_code LIKE \'%'.$item_code.'%\')';
    }
    if (isset($_GET['year']) AND !empty($_GET['year'])) {
        $selected_year = (integer)$_GET['year'];
    } else {
        $selected_year = date('Y')-1;
    }
    $reportgrid->setSQLCriteria($criteria);
**/

    // callback function to show overdued list
    function showUsage($obj_db, $array_data, $int_current_field_num)
    {
        global $selected_year;
        $_usage_q = $obj_db->query('SELECT COUNT(*) FROM COA AS c
            WHERE c.idcoa=\''.$array_data[0].'\' AND l.loan_date LIKE \''.$selected_year.'-'.$array_data[$int_current_field_num].'%\'');
        $_usage_d = $_usage_q->fetch_row();
        return ($_usage_d[0]=='0')?'<span style="color: #ff0000;">0</span>':'<strong>'.$_usage_d[0].'</strong>';
    }
    //** modify column value
    $reportgrid->modifyColumnContent(2, 'callback{showUsage}');
    $reportgrid->modifyColumnContent(3, 'callback{showUsage}');
    $reportgrid->modifyColumnContent(4, 'callback{showUsage}');
    $reportgrid->modifyColumnContent(5, 'callback{showUsage}');
    $reportgrid->modifyColumnContent(6, 'callback{showUsage}');
    $reportgrid->modifyColumnContent(7, 'callback{showUsage}');
    $reportgrid->modifyColumnContent(8, 'callback{showUsage}');
    $reportgrid->modifyColumnContent(9, 'callback{showUsage}');
    $reportgrid->modifyColumnContent(10, 'callback{showUsage}');
    $reportgrid->modifyColumnContent(11, 'callback{showUsage}');
    $reportgrid->modifyColumnContent(12, 'callback{showUsage}');
    $reportgrid->modifyColumnContent(13, 'callback{showUsage}');
    //**/
    // no sort column
    $reportgrid->disableSort(__('Jan'), __('Feb'), __('Mar'), __('Apr'), __('May'), __('Jun'), __('Jul'), __('Aug'), __('Sep'), __('Oct'), __('Nov'), __('Dec'));

    // put the result into variables
    echo $reportgrid->createDataGrid($dbs, $table_spec, 20);

    echo '<script type="text/javascript">'."\n";
    echo 'parent.$(\'pagingBox\').update(\''.str_replace(array("\n", "\r", "\t"), '', $reportgrid->paging_set).'\');'."\n";
    echo '</script>';

    $content = ob_get_clean();
}
?>
