<?php 
 
namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\ProductModel;
use Config\Services;
 
class Product extends Controller
{
 
    public function __construct() {
 
        // Mendeklarasikan class ProductModel menggunakan $this->product
        $this->product = new ProductModel();
        /* Catatan:
        Apa yang ada di dalam function construct ini nantinya bisa digunakan
        pada function di dalam class Product 
        */
        helper(['form', 'url']);
    }
 
    public function index()
    {
        $data = array(
            'product' => $this->product->getProduct()
        );
        echo view('product/index', $data);
    } 

    public function create(){

        $validation = $this->validate([
            'product_name' => ['label' => 'Country', 'rules' => 'required'],
            'product_description' => ['label' => 'Time Zone', 'rules' => 'required']
        ]);

        if (!$validation) {
            $data['validation'] = $this->validator;
            echo view('product/create', $data);
        } else{
            $data_product= array(
                'product_name' => $this->request->getPost('product_name'),
                'product_description' => $this->request->getPost('product_description')
            );

            $this->product->insertProduct($data_product);
            // Deklarasikan session flashdata dengan tipe success
            session()->setFlashdata('success', 'Created product successfully');
            // Redirect halaman ke product
            return redirect()->to(base_url('product')); 
        }
    }

    public function edit($id){
        $validation = $this->validate([
            'product_name' => ['label' => 'Country', 'rules' => 'required'],
            'product_description' => ['label' => 'Time Zone', 'rules' => 'required']
        ]);

        $data = array(
            'product' => $this->product->findProduct($id)
        );

        if (!$validation) {
            $data['validation'] = $this->validator;
            echo view('product/edit', $data);
        } else{
            $data_product= array(
                'product_name' => $this->request->getPost('product_name'),
                'product_description' => $this->request->getPost('product_description')
            );

            $this->product->updateProduct($id, $data_product);
            // Deklarasikan session flashdata dengan tipe success
            session()->setFlashdata('success', 'Updated product successfully');
            // Redirect halaman ke product
            return redirect()->to(base_url('product')); 
        }
    }

    public function delete($id)
    {
        // Memanggil function delete_product() dengan parameter $id di dalam ProductModel dan menampungnya di variabel hapus
        $hapus = $this->product->delete_product($id);
    
        // Jika berhasil melakukan hapus
        if($hapus)
        {
            // Deklarasikan session flashdata dengan tipe warning
            session()->setFlashdata('warning', 'Deleted product successfully');
            // Redirect ke halaman product
            return redirect()->to(base_url('product'));
        }
    } 

    public function ajax_list()
    {
    $request = Services::request();
    $m_product = new ProductModel($request);
    if($request->getMethod(true)=='POST'){
        $lists = $m_product->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                    $no++;
                    $row = [];
                    $row[] = $no;
                    $row[] = $list->product_name;
                    $row[] = $list->product_descrption;
                    $data[] = $row;
        }
        $output = ["draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_product->count_all(),
                            "recordsFiltered" => $m_product->count_filtered(),
                            "data" => $data];
        echo json_encode($output);
    }
    }
}