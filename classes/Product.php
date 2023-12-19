<?php

include_once 'lib/Database.php';

class Product
{

    public $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addProduct($data, $file) {
        $title = $data['title'];
        $subtitle = $data['subtitle'];
        $description = $data['description'];

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['photo']['name'];
        $file_size = $file['photo']['size'];
        $file_temp = $file['photo']['tmp_name'];


        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $upload_image = "upload/" . $unique_image;


        if (empty($title) || empty($subtitle) || empty($description) || empty($file_temp) || empty($upload_image)) {
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

            $query = "INSERT INTO `tbl_products`(`title`, `subtitle`, `photo`, `description`) VALUES ('$title', '$subtitle', '$upload_image', '$description')";

            $result = $this->db->insert($query);

            if ($result) {
                $msg = "Product added successful";
                return $msg;
            } else {
                $msg = "Product added failed";
                return $msg;
            }
        }

    }
    public function allProducts() {
        $query = "SELECT * FROM tbl_products ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getProductById($id) {
        $query = "SELECT * FROM tbl_products WHERE id ='$id'";
        $result = $this->db->select($query);
        return $result;
    }

    // Update Product
    public function updateProduct($data, $file, $id) {
        $title = $data['title'];
        $subtitle = $data['subtitle'];
        $description = $data['description'];

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['photo']['name'];
        $file_size = $file['photo']['size'];
        $file_temp = $file['photo']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $upload_image = "upload/" . $unique_image;


        if (empty($title) || empty($subtitle) || empty($description)) {
            $msg = "Please Must Not Be empty";
            return $msg;
        } if (!empty($file_name) ) {
            if ($file_size > 1048567) {
                $msg = "File size must be less the 1 MB";
                return $msg;
            } elseif (in_array($file_ext, $permited) == false) {
                $msg = "You can upload only" . implode(", ", $permited);
                return $msg;
            } else {

                $img_query = "SELECT * FROM tbl_products WHERE id='$id'";
                $img_res = $this->db->select($img_query);
                if($img_res) {
                    while($row = mysqli_fetch_assoc($img_res)) {
                        $photo = $row['photo'];
                        unlink($photo);
                    }
                }

                move_uploaded_file($file_temp, $upload_image);
    
                $query = "UPDATE tbl_products SET title = '$title', subtitle = '$subtitle', photo = '$upload_image', description = '$description' WHERE id='$id'";
                $result = $this->db->insert($query);
    
                if ($result) {
                    $msg = "Product update successful";
                    return $msg;
                } else {
                    $msg = "update failed";
                    return $msg;
                }
            }
        } else {
            $query = "UPDATE tbl_products SET title = '$title', subtitle = '$subtitle', description = '$description' WHERE id='$id'";
                $result = $this->db->insert($query);
    
                if ($result) {
                    $msg = "Product update successful";
                    return $msg;
                } else {
                    $msg = "update failed";
                    return $msg;
                }
        }
    }

    // Delete Product
    public function delProduct($id) {
        $img_query = "SELECT * FROM tbl_products WHERE id='$id'";
        $img_res = $this->db->select($img_query);
        if($img_res) {
            while($row = mysqli_fetch_assoc($img_res)) {
                $photo = $row['photo'];
                unlink($photo);
            }
        }

        $del_query = "DELETE FROM tbl_products WHERE id ='$id'";
        $del = $this->db->delete($del_query);
        if ($del) {
            $msg = "Product delete successful";
            return $msg;
        } else {
            $msg = "delete failed";
            return $msg;
        }
    }
}