<?php
ob_start();
session_start();
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="uk">

<head>
    <title> File Management </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style_file_mangment.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/all.min.css">

</head>

<body>
    <header>
        <div class="header">
            <div class="logo">
                <h1 class="logo">File Managment System</h1>
            </div>
            <div class="nav">
                <a href="logout.php" class="subnav"><i class="fas fa-sign-out-alt ta"></i>Logout</a>
                <a href="#" class="subnav"><i class="fas fa-user-shield ta"></i>Admin</a>
            </div>
        </div>

    </header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse under-nav" id="navbarTogglerDemo01">
            <h1 style="font-size: 32px;"><i class="fas fa-database" style="padding-right:20px "></i>File Manger</h1>
        </div>
        <!--  upload file -->
        <div class="button">
            <button class="btn btn-outline-primary my-2 my-sm-0 " id="btno_file" type="submit" name="submitco" style="margin:15px">uplode file</button>
            <!-- end  upload file -->

            <!--  create folder -->
            <button class="btn btn-outline-success my-2 my-sm-0 " id="btno_folder" type="submit" name="submitc">Create Folder</button>
            <!-- end  create Folder -->
        </div>
    </nav>
    <!-- model for upload file  -->
    <div class="modal" tabindex="-1" role="dialog" id="modal_file" style="display:none">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload File </h5>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="file" name="file">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id='btnc_file'>Close</button>
                            <input type="submit" value="Upload Image" name="submit-file" class="btn btn-primary">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- modal for create Folder  -->

    <div class="modal" tabindex="-1" role="dialog" id="modal_folder" style="display:none">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Folder</h5>
                </div>
                <div class="modal-body">
                    <p>Write Name Folder</p>
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="text" name="folder" value="" placeholder="write here name of folder" style="width: 100%">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id='btnc_folder'>Close</button>
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit-folder">Create Folder</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- start of table to show the file and folder -->
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Title/Name<i class="fas fa-chevron-down ta"></i></th>
                    <th scope="col">File Type<i class="fas fa-chevron-down ta"></i></th>
                    <th scope="col">Data Added<i class="fas fa-chevron-down ta"></i></th>
                    <th scope="col">Manage</th>
                    <th scope="col">Chick box</th>
                </tr>
            </thead>
            <tbody>

                <footer class="footer">
                    <p>
                        Crafted at training with sprintive

                    </p>
                </footer>
                <?php

                $current_path = "folder_of_user" . "/" . $user;
                if (isset($_GET['another-path'])) {
                    $current_path = $_GET['another-path'];
                }
                function show_content($current_path)
                {
                    if (is_dir($current_path)) {
                        $current_folder = scandir($current_path);
                        foreach ($current_folder as $key => $value) {
                            echo "<tr>";
                            if ($value != '.' && $value != '..') {

                                echo "<th class = 'color-font'>$value</th>";
                                echo "<th class='gray-color'>" . get_type_of_file($current_path . "/" . $value) . "</th>";
                                echo "<th class='gray-color' >" . get_date_of_file($current_path . "/" . $value) . "</th>";
                                if (is_dir($current_path . "/" . $value)) {
                                    $folder = "file_mangment.php?another-path=$current_path/$value";
                                    $delete_folder = "file_mangment.php?delete_folder=$current_path/$value";
                                    echo  "<th >" . '<a href="' . $folder . '" style="margin:15px; color:green;  border: gray 1px solid;"  target="_blank" ><i class="fas fa-eye"></i></a>' . '<a href="' . $delete_folder . '" style="margin:15px;color:red;  border: gray 1px solid;"  ><i class="far fa-trash-alt"></i></a>' . "</th>";
                                } else {
                                    echo  "<th  >" . '<a href="view.php?show_file=' . $current_path . '/' . $value . '" style="margin:15px;color:green;  border: gray 1px solid;"  target="_blank" ><i class="fas fa-eye"></i></a>' . '<a href="file_mangment.php?fileDelete=' . $current_path . '/' . $value . '" style="margin:15px;color:red;  border: gray 1px solid;" ><i class="far fa-trash-alt"></i></a>' .  "</th>";
                                }
                                echo  "<th  >" . '<input type="checkbox" name="checkbox" class="checkbox">' . "</th>";
                                echo  "</tr>";
                            }
                        }
                    }
                }
                show_content($current_path);

                echo "</div>";
                //------------------------------start create folder or upload file -------------------------

                if (isset($_POST['submit-file'])) {
                    if (isset($_FILES['file'])) {
                        $errors = array();
                        $file_name = $_FILES['file']['name'];
                        $file_size = $_FILES['file']['size'];
                        $file_tmp = $_FILES['file']['tmp_name'];
                        $file_type = $_FILES['file']['type'];

                        if ($file_size > 2097152) {
                            $errors[] = 'File size must be exactly 2 MB';
                        }
                        if (empty($errors) == true) {
                            move_uploaded_file($file_tmp, $current_path . "/" . $file_name);
                            header("refresh: 0");
                        } else {
                            print_r($errors);
                            ob_end_flush();
                        }
                    }
                }
                if (isset($_POST['submit-folder'])) {
                    if (is_dir($current_path)) {
                        $folder_name = $_POST['folder'];
                        if (!empty($folder_name)) {
                            mkdir($current_path . '/' . $folder_name, 777, true);
                            header("refresh: 0");
                        } else {
                            echo "Please Fill the Field of Folder";
                        }
                    }
                }

                // --------------------------------------- delete folder------------------------------------------

                if (isset($_GET['delete_folder'])) {
                    $detele_folder = $_GET['delete_folder'];
                    deleteDirectory($detele_folder);
                }
                function deleteDirectory($dir)
                {
                    if (!file_exists($dir)) {
                        return true;
                    }
                    if (!is_dir($dir)) {
                        return unlink($dir);
                    }
                    foreach (scandir($dir) as $item) {
                        if ($item == '.' || $item == '..') {
                            continue;
                        }
                        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                            return false;
                        }
                    }
                    return rmdir($dir);
                }

                // --------------------------------------delete file---------------------------------
                if (isset($_GET['fileDelete'])) {
                    unlink($_GET['fileDelete']);
                }

                //----------------------------get type of file or folder----------------------------------
                function get_type_of_file($file)
                {
                    $filePath = __DIR__ . "/" . $file;
                    if (is_dir($filePath)) {
                        return "Folder  <i class='far fa-folder-open'></i>";
                    } else {
                        return pathinfo($filePath, PATHINFO_EXTENSION);
                    }
                }

                //---------------------------------get date of create folder or file----------------------------
                function get_date_of_file($file)
                {

                    $filePath = __DIR__ . "/" . $file;
                    return date("m/d/Y    i:a", filectime($filePath));
                }
                ?>

                <!--------modal-------->
                <script type="text/javascript">
                    const model = document.getElementById('modal_folder');
                    const btn = document.getElementById("btno_folder");
                    const btnc = document.getElementById('btnc_folder');
                    btn.onclick = function() {
                        model.style.display = 'block';
                    };
                    btnc.onclick = function() {
                        model.style.display = 'none';
                    };

                    const mode_filel = document.getElementById('modal_file');
                    const btn_file = document.getElementById("btno_file");
                    const btnc_file = document.getElementById('btnc_file');
                    btn_file.onclick = function() {
                        mode_filel.style.display = 'block';
                    };
                    btnc_file.onclick = function() {
                        mode_filel.style.display = 'none';
                    }
                </script>

</body>

</html>