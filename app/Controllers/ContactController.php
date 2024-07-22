<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Contact;
use CodeIgniter\HTTP\ResponseInterface;

class ContactController extends BaseController
{
    protected $contact;
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'phone', 'address'];

    function __construct()
    {
        $this->contact = new Contact();
    }

    public function index()
    {
        $data['contacts'] = $this->contact->findAll();
        return view('contacts/index', $data);
    }

    public function create()
    {
        // Validation rules
        $validation = $this->validate([
            'name' => 'required',
            'email' => 'required|valid_email',
            'phone' => 'required',
            'address' => 'required'
        ]);

        if (!$validation) {
            // If validation fails, redirect back with input and errors
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // If validation passes, insert data into the database
        $this->contact->insert([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
        ]);

        return redirect()->to('/contact')->with('success', 'Data Added Successfully'); // Changed redirect method
    }

    public function edit($id)
    {
        
        $this->contact->update($id, [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'phone' => $this->request->getPost('phone'),
                'address' => $this->request->getPost('address'),
            ]);

            return redirect('contact')->with('success', 'Data Updated Successfully');
    }

    public function delete($id){
        $this->contact->delete($id);

        return redirect('contact')->with('success', 'Data Deleted Successfully');
    }
}
