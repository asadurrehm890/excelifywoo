<?php

class excelifywoo_admin_export{
   public static function excelifywoo_export_csv(){
        require_once ABSPATH . '/wp-load.php';
        require_once ABSPATH . '/wp-admin/includes/export.php';
        require_once ABSPATH . '/wp-admin/includes/file.php';

        $filename = 'woocommerce-products.csv';

        
        $product_data = array(
            'ID',
            'post_title',
            'post_content',
            'meta:_regular_price',
            'meta:_sku',
        
        );

        

        ob_start();
        export_wp(array('content' => 'products', 'fields' => $product_data));
        $export_data = ob_get_clean();

        $upload_dir = wp_upload_dir();
        $file_path = $upload_dir['basedir'] . '/' . $filename;
        $file_url = $upload_dir['baseurl'] . '/' . $filename;

        $file_handle = fopen($file_path, 'w');
        fwrite($file_handle, $export_data);
        fclose($file_handle);

        wp_send_json_success($file_url);
   }

   public static function excelifywoo_export_display(){
?>

<header class="excelify-header">
  <h1>Excelifywoo</h1>
</header>
<main class="excelify-main">
    <button id="exportproducts" class="btn1">Export Products</button>


</main>
<footer class="excelify-footer">

   </footer>

<?php
   }

} 



