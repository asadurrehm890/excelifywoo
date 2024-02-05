<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://urasaapi.com
 * @since      1.0.0
 *
 * @package    Excelifywoo
 * @subpackage Excelifywoo/admin/partials
 */
 
 require_once dirname(__FILE__).'/class-excelifywoo-productupload.php';
 require_once dirname(__FILE__).'/class-excelifywoo-img.php';
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<header class="excelify-header">
  <h1>Excelifywoo</h1>
</header>
<main class="excelify-main">
	<div class="excelify-container">
		<form method="post" enctype="multipart/form-data">
			
			<input type="file" name="excel_file" accept=".csv">
			
			<input type="submit" name="submit" value="Upload">
		</form>
	</div>
	<?php
if (isset($_FILES['excel_file'])) {
    $upload_dir = wp_upload_dir(); // Get the upload directory path

    $file_name = $_FILES['excel_file']['name'];
    $file_tmp = $_FILES['excel_file']['tmp_name'];
    $folder_path = $upload_dir['path'] . '/excels'; // Folder path
    $file_path = $folder_path . '/' . $file_name; // Destination path

    // Create the folder if it doesn't exist
    if (!file_exists($folder_path)) {
        wp_mkdir_p($folder_path);
    }

    if (move_uploaded_file($file_tmp, $file_path)) {
        echo '<br><p>File uploaded successfully.</p></br>';
		$handle = fopen($file_path, 'r');
		fgetcsv($handle);
		
		  while (($data = fgetcsv($handle)) !== false) {
			 
            // var_dump($data);die;			 
            $title = $data[0];
            $description = $data[1];
            $price = $data[2];
			$sku = $data[3];
            $img = $data[4];
			$short = $data[5]; 
			$sale=$data[6]; 
			$sale_start=$data[7];
			$sale_end=$data[8];  
            // Add more fields as needed

            $imgurl=Excelifywoo_Img::excelify_img_upload($img);   

            $product_data = array(
                'name' => $title,
                'description' => $description,
                'regular_price' => $price,
				'sku' => $sku,
                'img'=>$imgurl,
				'short'=>$short,
				'sale'=>$sale,
				'saleStart'=>$sale_start,
				'saleEnd'=>$sale_end,
				
                // Add more fields as needed
            );

            $product_id = Excelifywoo_Productupload::excelifywoo_create_product($product_data);
            if ($product_id) {
                echo 'Product created: ' . $title . '<br>';
            } else {
                echo 'Error creating product: ' . $title . '<br>';
            }
        }
		
    } else {
        echo 'Error uploading file.';
    }
}
?>
</main>
<footer class="excelify-footer">
</footer>