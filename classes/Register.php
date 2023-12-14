<?php

include_once 'lib/Database.php';

class Register
{

    public $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addRegister($data, $file) {
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $address = $data['address'];

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['photo']['name'];
        $file_size = $file['photo']['size'];
        $file_temp = $file['photo']['tmp_name'];


        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $upload_image = "upload/" . $unique_image;


        if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($file_temp) || empty($upload_image)) {
            $msg = "Please Must Not Be empty";
            return $msg;
        } elseif ($file_size > 1048567) {
            $msg = "File size must be less the 1 MB";
            return $msg;
        } elseif (in_array($file_ext, $permited) == false) {
            $msg = "You can upload only" . implode(", ", $permited);
            return $msg;
        } else {
            move_uploaded_file($file_temp, $upload_image);

            $query = "INSERT INTO `tbl_register`(`name`, `email`, `phone`, `photo`, `address`) VALUES ('$name', '$email', '$phone', '$upload_image', '$address')";

            $result = $this->db->insert($query);

            if ($result) {
                $msg = "Registration successful";
                return $msg;
            } else {
                $msg = "Registration failed";
                return $msg;
            }
        }

    }
    public function allStudent() {
        $query = "SELECT * FROM tbl_register ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getStdById($id) {
        $query = "SELECT * FROM tbl_register WHERE id ='$id'";
        $result = $this->db->select($query);
        return $result;
    }
}