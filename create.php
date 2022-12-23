<?php
require_once "config.php";

$name = $nim = $prodi = $semester = $IP = "";
$name_err = $nim_err = $prodi_err = $semester_err = $ip_err ="";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $input_name = trim($_POST["name"]);
    if(empy($input_name)){
        $name_err = "Tolong masukkan nama anda.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Tolong masukkan nama anda dengan benar.";
    } else {
        $name = $input_name;
    }

    $input_nim = trim($_POST["NIM"]);
    if(empty($input_nim)){
        $nim_err = "Tolong masukkan NIM anda.";
    } elseif(!ctype_digit($input_nim)){
        $nim_err = "Tolong masukkan nim anda dengan benar.";
    } else {
        $nim = $input_nim;
    }

    $input_prodi = trim($_POST["Program Studi"]);
    if(empty($input_prodi)){
        $prodi_err = "Tolong masukkan program studi anda.";
    } else {
        $prodi = $input_prodi;
    }

    $input_semester = trim($_POST["Semester"]);
    if(empty($input_semester)){
        $semester_err = "Tolong masukkan semester anda";
    } elseif(!ctype_digit($input_semester)) {
        $semester_err = "Tolong masukkan angka dengan benar.";
    } else {
        $semester = $input_semester;
    }

    $input_ip = trim($_POST["Index Prestasi"]);
    if(empty($input_ip)){
        $ip_err = "Tolong masukkan Index Prestasi anda.";
    } elseif(!ctype_digit($input_ip)) {
        $ip_err = "Tolong masukkan Index prestasi anda dengan benar.";
    } else {
        $IP = $input_ip;
    }

    if(empty($name_err) && ($nim_err) && ($prodi_err) && ($semester_err) && ($ip_err)) {
        $sql = "INSERT INTO employees (name, nim, prodi, semester, IP) VALUES (?, ?, ?, ?, ?)";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_nim, $param_prodi, $param_semester, $param_ip);

            $param_name = $name;
            $param_nim = $nim;
            $param_prodi = $prodi;
            $param_semester = $semester;
            $param_ip = $Ip;

            if(msqli_stmt_execute($stmt)) {
                header("location: index.php");
                exit();
            } else {
                echo "Ada yang salah.  Coba beberapa saat lagi.";
            }
        }
        msqli_stmt_close($stmt);
    }
    msqli_close($link);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Buat Data</title>
        <style type="text/css">
            .wrapper{
            width: 500px;
            margin: 0 auto;
        }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header">
                            <h2>Tambah Data</h2>
                        </div>
                        <p>Isi form untuk menambahkan data mahasiswa</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($nim_err)) ? 'has-error' : ''; ?>">
                            <label>NIM</label>
                            <textarea name="nim" class="form-control"><?php echo $nim; ?></textarea>
                            <span class="help-block"><?php echo $nim_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($prodi_err)) ? 'has-error' : ''; ?>">
                            <label>Program Studi</label>
                            <input type="text" name="prodi" class="form-control" value="<?php echo $prodi; ?>">
                            <span class="help-block"><?php echo $prodi_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($semester_err)) ? 'has-error' : ''; ?>">
                            <label>Semester</label>
                            <input type="text" name="semester" class="form-control" value="<?php echo $semester; ?>">
                            <span class="help-block"><?php echo $semester_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($ip_err)) ? 'has-error' : ''; ?>">
                            <label>Index Prestasi</label>
                            <input type="text" name="index_prestasi" class="form-control" value="<?php echo $IP; ?>">
                            <span class="help-block"><?php echo $ip_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </body>