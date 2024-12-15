<?php
require '../config/connection.php';

$provinceId = $_POST['province-id'];
?>

<select id="form_kab">
    <option value="">Select City</option>
    <?php
    $result = mysqli_query($conn, "SELECT id, name FROM cities WHERE province_id = '$provinceId' ORDER BY name");

    while ($data = mysqli_fetch_array($result)) {
    ?>
        <option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
    <?php
    }
    ?>
</select>