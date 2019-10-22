<?php

	defined('BASEPATH') or exit('No Direct Script is allowed');

	/**
	 * 
	 */
	class Cart_model extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function add_to_cart(){

			$comboid = $this->input->post('productid');
			$type = $this->input->post('type');
			$qty = $this->input->post('qty');


			$this->db->select('*');
			$this->db->from('whole_products a');
			$this->db->join('whole_product_combinations b', 'b.combination_product = a.product_id','left');
			$this->db->join('whole_product_options c', 'c.p_attribute_combo = b.combination_id','left');
			$this->db->where('combination_id',$comboid);
			$products = $this->db->get()->row();

			if($this->session->user_id){

				$this->db->where('cart_user_id',$this->session->user_id);
				$this->db->where('cart_combo_id',$comboid);
				$cart = $this->db->get('whole_cart');

				if($cart->num_rows() > 0){
					echo json_encode(['msg' => 'already']);
					exit;
				}

				$this->db->where('wishlist_product',$comboid);
				$this->db->where('wishlist_user',$this->session->user_id);
				$this->db->delete('whole_wishlist');

				$data = array(
					'cart_user_id' => $this->session->user_id,
					'cart_combo_id' => $comboid,
					'cart_qty' => $qty,
				);

				$query = $this->db->insert('whole_cart',$data);

				if($query){

					$this->db->where('cart_user_id',$this->session->user_id);
					$cart = $this->db->get('whole_cart')->num_rows();

					echo json_encode(['msg' => 'done','count' => $cart]);
					exit;
				}else{
					echo json_encode(['msg' => 'error']);
					exit;
				}

			}else{

				$data = array(
					'id' => $comboid,
					'qty' => $qty,
					'price' => $products->combination_sale_price,
					'name' => $products->product_name,
					'mrp' => $products->combination_price,
				);

				$query = $this->cart->insert($data);

				if($query){

					$cart = count($this->cart->contents());

					echo json_encode(['msg' => 'done','count' => $cart]);
					exit;
				}else{
					echo json_encode(['msg' => 'error']);
					exit;
				}
			}
		}

		public function get_cart_items(){

			$this->db->select('*');
			$this->db->from('whole_cart a');
			$this->db->join('whole_product_combinations b','b.combination_id = a.cart_combo_id','left');
			$this->db->join('whole_products c','c.product_id = b.combination_product','left');
			$this->db->join('whole_product_options d','d.p_attribute_combo = b.combination_id','left');
			$this->db->join('whole_attribute_options e','e.option_id = d.p_attribute_value','left');
			$this->db->where('cart_user_id',$this->session->user_id);
			return $this->db->get()->result();
		}

		public function delete_cart(){

			$id = $this->input->post('id');
			$type = $this->input->post('type');

			$subtotal = $total = $discount = 0;

			if($this->session->user_id){

				if($type == 'all'){
					$this->db->where('cart_user_id',$this->session->user_id);
					$this->db->delete('whole_cart');
				}else{
					$this->db->where('cart_id',$id);
					$this->db->delete('whole_cart');
				}


				if($this->db->affected_rows() > 0){

					$this->db->select('*');
					$this->db->from('whole_cart a');
					$this->db->join('whole_product_combinations b','b.combination_id = a.cart_combo_id','left');
					$this->db->join('whole_products c','c.product_id = b.combination_product','left');
					$this->db->join('whole_product_options d','d.p_attribute_combo = b.combination_id','left');
					$this->db->join('whole_attribute_options e','e.option_id = d.p_attribute_value','left');
					$this->db->where('cart_user_id',$this->session->user_id);
					$cart = $this->db->get();

					if($cart->num_rows() > 0){

						foreach($cart->result() as $item){

							$subtotal += ($item->combination_price * $item->cart_qty);
              				$total += ($item->combination_sale_price * $item->cart_qty);
              				$discount += ($item->combination_price - $item->combination_sale_price) * $item->cart_qty;
						}

					}

					$data = array(
						'subtotal' => $subtotal,
						'discount' => $discount,
						'total' => $total,
						'msg' => 'done'
					);

					echo json_encode($data);
					exit;
				}else{
					echo json_encode(['msg' => 'error']);
					exit;
				}

			}else{

				if($type == 'all'){
					$query = $this->cart->destroy();
				}else{
					$data = array(
		    	        'rowid' => $id,
		    	        'qty'   => 0,
		    		);
		        
				    $query = $this->cart->update($data);
				} 
			    if($query){

			    	if($this->cart->contents()){ 
			    		foreach($this->cart->contents() as $item){

			    			$subtotal += ($item['mrp'] * $item['qty']);
          					$total += ($item['price'] * $item['qty']);
          					$discount += ($item['mrp'] - $item['price']) * $item['qty'];
			    		}
			   	 	}

			        $data = array(
						'subtotal' => $subtotal,
						'discount' => $discount,
						'total' => $total,
						'msg' => 'done'
					);

					echo json_encode($data);
					exit;
			    }else{
			        echo json_encode(['msg' => 'error']);
					exit;
			    } 
			}
		}

		public function update_cart(){

			$id = $this->input->post('id');
			$qty = $this->input->post('qty');
			$subtotal = $total = $discount = 0;
			if($this->session->user_id){

				$this->db->where('cart_id',$id);
				$query = $this->db->update('whole_cart',['cart_qty' => $qty]);

				if($query){

					$this->db->select('*');
					$this->db->from('whole_cart a');
					$this->db->join('whole_product_combinations b','b.combination_id = a.cart_combo_id','left');
					$this->db->join('whole_products c','c.product_id = b.combination_product','left');
					$this->db->join('whole_product_options d','d.p_attribute_combo = b.combination_id','left');
					$this->db->join('whole_attribute_options e','e.option_id = d.p_attribute_value','left');
					$this->db->where('cart_user_id',$this->session->user_id);
					$cart = $this->db->get();

					if($cart->num_rows() > 0){

						foreach($cart->result() as $item){

							$subtotal += ($item->combination_price * $item->cart_qty);
              				$total += ($item->combination_sale_price * $item->cart_qty);
              				$discount += ($item->combination_price - $item->combination_sale_price) * $item->cart_qty;
						}

					}

					$data = array(
						'subtotal' => $subtotal,
						'discount' => $discount,
						'total' => $total,
						'msg' => 'done'
					);

					echo json_encode($data);
					exit;
				}else{
					echo json_encode(['msg' => 'error']);
					exit;
				}
			}else{

				$data = array(
	    	        'rowid' => $id,
	    	        'qty'   => $qty,
	    		);
	        
			    $query = $this->cart->update($data);

			    if($query){

			    	if($this->cart->contents()){ 
			    		foreach($this->cart->contents() as $item){

			    			$subtotal += ($item['mrp'] * $item['qty']);
          					$total += ($item['price'] * $item['qty']);
          					$discount += ($item['mrp'] - $item['price']) * $item['qty'];
			    		}
			   	 	}

			        $data = array(
						'subtotal' => $subtotal,
						'discount' => $discount,
						'total' => $total,
						'msg' => 'done'
					);

					echo json_encode($data);
					exit;
			    }else{
			        echo json_encode(['msg' => 'error']);
					exit;
			    }
			}
		}

		public function get_deliverystatus(){

			if(!$this->session->zip_code){

				$this->db->where('user_id',$this->session->user_id);
				$this->db->where('add_status','1');
				$address = $this->db->get('whole_user_address');
				if($address->num_rows() > 0){
					$this->db->order_by('id','desc');
					$this->db->limit(1);
					$this->db->where('order_user',$this->session->user_id);
					$orders = $this->db->get('whole_orders');
					if($orders->num_rows() > 0){
						$order = $orders->row();
						$this->db->where('add_id',$order->order_user_add);
						$this->db->where('add_status','1');
						$address = $this->db->get('whole_user_address');
						if($address->num_rows() > 0){
							$add = $address->row();
							$this->session->set_userdata('zip_code',$add->user_zip_code);
							return true;
						}else{
							return false;
						}
					}else{
						$this->db->order_by('add_id','desc');
						$this->db->limit(1);
						$this->db->where('user_id',$this->session->user_id);
						$this->db->where('add_status','1');
						$address = $this->db->get('whole_user_address');
						if($address->num_rows() > 0){
							$add = $address->row();
							$this->session->set_userdata('zip_code',$add->user_zip_code);
							return true;

						}else{
							return false;
						}
					}
				}else{
					return false;
				}
			}
		}

		public function check_zip(){
			$code = $this->input->post('code');
			$this->db->where('zip_code',$code);
			$codes = $this->db->get('whole_zipcodes');
			if($codes->num_rows() > 0){
				$add = $codes->row();
				$this->session->set_userdata('zip_code',$add->zip_code);
				return true;
			}else{
				return false;
			}
		}
	}