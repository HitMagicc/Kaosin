<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Barang;
use App\Models\Kategori;
use Ramsey\Uuid\Uuid;

class BarangController extends BaseController
{
    public function add()
    {
        // Load categories for the dropdown
        $kategoriModel = new Kategori();
        $data['kategori'] = $kategoriModel->findAll();
        return view('admin/barang/add', $data);
    }
    public function store()
    {
        $barangModel = new Barang();

        // Handle file upload
        $file = $this->request->getFile('files'); // Debugging starts here
        // Check if file is received

        $imagePath = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Generate a unique name for the file
            $newName = $file->getRandomName();

            // Define the target directory
            $targetDirectory = 'uploads/productImage';

            // Check if directory exists
            if (!is_dir($targetDirectory)) {
                dd("Directory does not exist: " . $targetDirectory);
            }

            // Move the file to the target directory
            if (!$file->move($targetDirectory, $newName)) {
                dd("File move failed!", $file->getErrorString(), $file->getError());
            }

            // Save the path to the database
            $imagePath = $targetDirectory . '/' . $newName;
        }
        // Prepare data for insertion
        $data = [
            'id' => Uuid::uuid4()->toString(),
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'desc' => $this->request->getPost('desc'),
            'kategori_id' => $this->request->getPost('kategori_id'),
            'stock' => $this->request->getPost('stock'),
            'image_path' => $imagePath, // Include image path
        ];

        // Insert data into the database
        $barangModel->insert($data);

        // Redirect to the barang list page
        return redirect()->to('admin/barang');
    }

    public function index()
    {
        $barangModel = new Barang();
        $kategoriModel = new Kategori(); // Assuming you have a Kategori model

        // Fetch all categories
        $categories = $kategoriModel->findAll();

        // Group categories by 'Sex'
        $groupedCategories = [];
        foreach ($categories as $category) {
            $groupedCategories[$category['Sex']][] = $category;
        }

        // Fetch all barang records, including their kategori details
        $barangs = $barangModel->getAllBarangWithKategori();

        // Define readable names for sexes
        $sexNames = [
            1 => 'Men',
            2 => 'Women',
            3 => 'Unisex',
        ];

        // Pass data to the view
        return view('admin/barang/index', [
            'barangs' => $barangs,
            'groupedCategories' => $groupedCategories,
            'sexNames' => $sexNames,
        ]);
    }

    
    public function sexx($sex){
        $barangModel = new Barang();
        if($sex=="Men"){
            $sex=1;
        }else if($sex=="Women"){
            $sex=2;
        }
        $barangs= $barangModel->getBarangWithSex($sex);

        return view('barang/index',['barang'=>$barangs]);
    }
    public function delete($id)
    {
        $barangModel = new Barang();

        // Check if the barang exists
        $barang = $barangModel->find($id);
        if ($barang) {
            // Get the image path from the record
            $imagePath = $barang['image_path'];

            // Check if the file exists and delete it
            if ($imagePath && file_exists($imagePath)) {
                unlink($imagePath); // Delete the file
            }

            // Delete the barang from the database
            $barangModel->delete($id);

            // Redirect with a success message
            return redirect()->to('/admin/barang')->with('message', 'Product and its image deleted successfully!');
        } else {
            // Redirect with an error message if the product doesn't exist
            return redirect()->to('/admin/barang')->with('error', 'Product not found.');
        }
    }
    public function detail($id){
        $barangModel = new Barang();
        $kategoriModel = new Kategori();

        // Fetch the current product along with its category information
        $barang = $barangModel->join('kategori', 'kategori.id = barang.kategori_id', 'left')
            ->select('barang.*, kategori.id as k_id, kategori.Name as kategori_name, kategori.Sex as kategori_sex')
            ->where('barang.id', $id)
            ->first();

        if (!$barang) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Barang not found");
        }

        // Fetch other products from the same category for recommendation
        $recommendedProducts = $barangModel->where('kategori_id', $barang['k_id'])
            ->where('barang.id !=', $id)  // Exclude the current product
            ->findAll();

        // Pass both the product and the recommended products to the view
        return view('product/detail', [
            'barang' => $barang,
            'recommendedProducts' => $recommendedProducts,  // Pass recommended products
        ]);

    }
    public function edit($id)
    {
        $barangModel = new Barang();

        // Fetch the barang record by ID
        $barang = $barangModel->find($id);

        if (!$barang) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Barang with ID $id not found.");
        }

        // Fetch all categories for the dropdown
        $kategoriModel = new \App\Models\Kategori(); // Assuming you have a Kategori model
        $kategori = $kategoriModel->findAll();

        return view('admin/barang/edit', [
            'barang' => $barang,
            'kategori' => $kategori,
        ]);
    }
    public function update($id)
    {
        $barangModel = new Barang();

        // Check if the barang exists
        $barang = $barangModel->find($id);

        if (!$barang) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Barang with ID $id not found.");
        }

        // Handle file upload (optional)
        $file = $this->request->getFile('files');
        $imagePath = $barang['image_path']; // Keep existing image if not updated

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $targetDirectory = 'uploads/productImage';

            if (!is_dir($targetDirectory)) {
                mkdir($targetDirectory, 0777, true);
            }

            if ($file->move($targetDirectory, $newName)) {
                $imagePath = $targetDirectory . '/' . $newName;

                // Optionally, delete the old file
                if (file_exists($barang['image_path'])) {
                    unlink($barang['image_path']);
                }
            }
        }

        // Prepare data for update
        $data = [
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'desc' => $this->request->getPost('desc'),
            'kategori_id' => $this->request->getPost('kategori_id'),
            'stock' => $this->request->getPost('stock'),
            'image_path' => $imagePath,
        ];

        // Update the record
        $barangModel->update($id, $data);

        // Redirect to barang list
        return redirect()->to('admin/barang');
    }



    public function catalog($kategoriId = null)
    {
        $kategoriModel = new Kategori();
        $barangModel = new Barang();

        // Fetch all categories for the sidebar
        $categories = $kategoriModel->findAll();

        // Group categories by 'Sex'
        $groupedCategories = [];
        foreach ($categories as $category) {
            $groupedCategories[$category['Sex']][] = $category;
        }

        // Fetch sex and category names
        $sexNames = [
            1 => 'Men',
            2 => 'Women',
            3 => 'Accessories',
        ];

        $selectedKategori = null;
        $selectedSex = null;

        $sex = $this->request->getGet('sex');
        if ($sex) {
            $products = $barangModel->getBarangBySex($sex);
            $selectedSex = $sexNames[$sex] ?? 'Unknown';
        } elseif ($kategoriId) {
            $products = $barangModel->getBarangByKategori($kategoriId);
            $selectedKategori = $kategoriModel->find($kategoriId)['Name'] ?? 'Unknown';
        } else {
            $products = $barangModel->getAllBarangWithKategori();
        }

        // Pass grouped data and context to the view
        return view('product/index', [
            'groupedCategories' => $groupedCategories,
            'products' => $products,
            'selectedKategori' => $selectedKategori,
            'selectedSex' => $selectedSex,
        ]);
    }

    public function barangMasukHariIni()
    {
        $barangModel = new Barang();
    
        // Ambil barang yang masuk hari ini
        $barangMasuk = $barangModel->getBarangMasukHariIni();
    
        return view('admin/index', ['barangMasuk' => $barangMasuk]);
    }
    


}
