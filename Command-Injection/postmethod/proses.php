<?php
  // Mengecek apakah tombol submit ditekan
  if(isset($_POST['host'])) {
    // Mengambil nilai input dari form
    $host = $_POST['host'];
    
    // Menjalankan perintah ping pada host menggunakan fungsi shell_exec()
    $output = shell_exec('ping -c 3 '.$host);
    
    // Menampilkan hasil ping ke dalam tag pre
    echo '<pre>'.$output.'</pre>';
  }
?>
