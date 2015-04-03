<ol class="breadcrumb">
  <?php
    if (!empty($arr_luuvet))
    {
        $i=1;
        foreach ($arr_luuvet as $key=>$value)
        {
            if ($i == count($arr_luuvet))
            {
                echo '<li class="active">'.$key.'</li>';
            }
            else
            {
                echo '<li>'.anchor($value,$key).'</li>';
                $i++;
            }
        }
        
    }
  ?>
</ol>