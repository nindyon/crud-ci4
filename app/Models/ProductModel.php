<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class ProductModel extends Model
{
    protected $table = "product";
    protected $primaryKey = 'product_id';
 
    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
    }

    

    public function getProduct()
    {
        $query = $this->db->table('product')
        ->get();

        return $query->getResult();
    } 

    public function findProduct($id)
    {
        $query = $this->db->table('product')
        ->where('product_id', $id)
        ->limit(1)
        ->get();

        return $query->getRow();
    } 

    public function insertProduct($data){
        return $this->db->table($this->table)->insert($data);
    }

    public function updateProduct($id, $data){
        return $this->db->table($this->table)
        ->where('product_id', $id)
        ->update($data);
    }

    public function delete_product($id)
    {
        return $this->db->table($this->table)
        ->where($this->primaryKey, $id)
        ->delete();
    } 
}