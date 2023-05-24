<!DOCTYPE html>
<html>
  <head>
    <title>Form Ping Jaringan</title>
  </head>
  <body>
    <h1>Form Ping Jaringan</h1>
    <?php
      // Mengecek apakah tombol submit ditekan
      if(isset($_GET['host'])) {
        // Mengambil nilai input dari form
        $host = $_GET['host'];

        // Menjalankan perintah ping pada host menggunakan fungsi shell_exec()
        $output = shell_exec('ping -c 3 '.$host);

        // Menghitung panjang output
        $panjang_output = strlen($output);

        // Mengatur header Content-Length
        header('Content-Length: ' . $panjang_output);

        // Menampilkan hasil ping ke dalam tag pre
        echo '<pre>'.$output.'</pre>';
      } else {
        // Menampilkan form jika tombol submit belum ditekan
    ?>
    <form action="" method="get">
      <label for="host">Host:</label>
      <input type="text" id="host" name="host"><br><br>
      <input type="submit" value="Ping">
    </form>
    <?php } ?>
  </body>
</html>