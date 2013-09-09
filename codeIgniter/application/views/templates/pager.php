<?php 
    if ($pagerName == "")
        $pagerName = "pager";        
?>
<div id="<?php echo $pagerName; ?>" class="pager" >
    <form>
        <img src="<?php echo CSS_PATH; ?>blue/first.png" class="first">
        <img src="<?php echo CSS_PATH; ?>blue/prev.png" class="prev">
        <span class="pagedisplay"></span>
        <img src="<?php echo CSS_PATH; ?>blue/next.png" class="next">
        <img src="<?php echo CSS_PATH; ?>blue/last.png" class="last">
        <select class="pagesize" hidden="true">
            <option selected="selected" value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="40">40</option>
        </select>
    </form>
</div>