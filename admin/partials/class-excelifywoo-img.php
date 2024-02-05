<?php 


class Excelifywoo_Img{
    public static function excelify_img_upload($link){
        
        $image_data = file_get_contents($link);
        
        if ($image_data === false) {
        
            die('Error downloading the image.');
        
        }

        
        
        $upload_dir = wp_upload_dir(); 
        
        $filename = wp_unique_filename($upload_dir['path'], basename($link));

        $file_path = $upload_dir['path'] . '/' . $filename;

        $result = file_put_contents($file_path, $image_data);
        
        if ($result === false) {
        
            die('Error saving the image file.');
        
        }

        $attachment = array(
            'guid'           => $upload_dir['url'] . '/' . $filename,
            'post_mime_type' => 'image/jpeg', 
            'post_title'     => sanitize_file_name($filename),
            'post_content'   => '',
            'post_status'    => 'inherit'
        );

        $attachment_id = wp_insert_attachment($attachment, $file_path, 0);

        if (!is_wp_error($attachment_id)) {
           
            require_once ABSPATH . 'wp-admin/includes/image.php';
        
            $attachment_data = wp_generate_attachment_metadata($attachment_id, $file_path);
        
            wp_update_attachment_metadata($attachment_id, $attachment_data);
        
        }

        if (!is_wp_error($attachment_id)) {
            echo 'Image downloaded and added to the media library successfully.';
        } else {
            echo 'Error: ' . $attachment_id->get_error_message();
        }

        $image_url = wp_get_attachment_url($attachment_id);
        return $attachment_id;

    } 
}