<?php

class Excelifywoo_Productupload{
	public static function excelifywoo_create_product($product_data){
		$product = new WC_Product();
		$product->set_name($product_data['name']);
		$product->set_description($product_data['description']);
		$product->set_regular_price($product_data['regular_price']);
		$product->set_short_description($product_data['short']);
		$product->set_sku($product_data['sku']);
		$product->set_type('simple');
		$product->set_sale_price($product_data['sale']);
		$product->set_date_on_sale_from( $product_data['saleStart'] );
		$product->set_date_on_sale_to( $product_data['saleEnd'] );
		$product->set_stock_status('instock');
		/*$product->set_manage_stock(true);
		$product->set_sold_individually(true);
		$product->set_weight(0.5);
		$product->set_dimensions(array(10, 5, 2));*/
		//$product->
		
		$product_id = $product->save();

		set_post_thumbnail($product_id ,$product_data['img']);
		return $product_id;
	}
}