<h3>Danh sách Logs</h3>
<?php
if ($handle = opendir(APPPATH.'logs/')) {
    /* This is the correct way to loop over the directory. */
    while (false !== ($entry = readdir($handle))) {
        if ($entry != '.' && $entry != '..')
        {
            $link = APPPATH.'logs/'.$entry;
            $name = $entry;
            ?>
            
            <a target="_blank" href="<?php echo base_url('c_home/download_log/'.$name) ?>"><?php echo $entry ?></a><br />
            <?php
        }
    }
    closedir($handle);
}
?>
