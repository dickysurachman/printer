<?php 

                        $y=10000;
                        $jj=5;
                        $serial="98ADJ002";
                        for($x=0;$x<=$y;$x++)
                        {
                            $kodesn=$serial. substr("00000000".$x, -1*$jj);
                            echo $kodesn."<br/>";
                        }


?>