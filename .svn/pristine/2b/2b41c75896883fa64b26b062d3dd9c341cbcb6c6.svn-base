<?php

  /**
   * Save form inputs
   */
  function my_download_form() {
    /**
     * DB Connection
     */
    require_once get_template_directory() . '/custom/functions/connector.php';

    $date = date('Y-m-d');
    $name = $_POST['name'];
    $division = $_POST['division'];
    $project = $_POST['project'];
    $email = $_POST['email'];

    $sql = "INSERT INTO downloads VALUES ('', '$name', '$division', '$project', '$email', '$date')";

    if ($conn->query($sql) == TRUE) {
      echo json_encode(
        array("success"=>"Successfully added.")
      );
    } else {
      echo json_encode(
        array("error"=>"$conn->error")
      );
    }

    $conn->close();

    wp_die();
  }
?>
