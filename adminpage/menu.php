<?php
include "../config/koneksi.php";

/**
 * @author AyankQ
 * @copyright 2012
 */

if ($_SESSION['leveluser']=='admin'){
echo "<ul> 
        <li><a href=?module=home>Home</a></li>";
                              
                $main = mysqli_query($con,"SELECT * FROM mainmenu WHERE aktif = 'N' AND adminmenu= 'Y'");
    
                while($r = mysqli_fetch_array($main)) {
                    echo '<li>';
                    if(empty($r[link])){
                        echo '<a>'.$r[nama_menu].'</a>';
                    }else{
                        echo '<a href="'.$r[link].'">'.$r[nama_menu].'</a>';
                    }
						
                    
					$sub = mysqli_query($con,"SELECT * FROM submenu, mainmenu 
          WHERE submenu.id_main = mainmenu.id_main AND submenu.id_main = $r[id_main] AND submenu.aktif='N'");
                    $jml = mysql_num_rows($sub);
                    // apabila sub menu ditemukan
                    if($jml > 0) {
                       	echo '<ul>';
                       	while($w=mysqli_fetch_array($sub)){
                           	echo '<li>';
								echo '<a href="'.$w[link_sub].'">'.$w[nama_sub].'</a>';
							echo '</li>';
                       	}           
                       	echo '</ul>';
						echo '</li>';
                    } else {
                        echo '</li>';
                    }
                }
echo "</ul>";

}
elseif ($_SESSION['leveluser']=='user'){
echo "<ul> 
        <li><a href=?module=home>Home</a></li>";
  $sql=mysqli_query($con,"select * from modul where status='user' and aktif='Y' order by urutan"); 

  while ($m=mysqli_fetch_array($sql)){  
    echo "<li><a href='$m[link]'>$m[nama_modul]</a></li>";
  }
echo "</ul>";

} 
?>
