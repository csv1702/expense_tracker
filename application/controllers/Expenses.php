<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        $this->load->model('Expense_model');
    }

    public function dashboard() {
        $user_id = $this->session->userdata('user_id');
        $filter = $this->input->get('filter');
        
        // 1. Get Table Data
        $data['expenses'] = $this->Expense_model->get_expenses($user_id, $filter);
        
        // 2. Get Summary Cards Data
        $data['summary'] = $this->Expense_model->get_summary($user_id); 
        
        // 3. Get Chart Data (This is the new line required for the graph)
        $data['chart_data'] = $this->Expense_model->get_chart_data($user_id);

        $data['current_filter'] = $filter;
        
        $this->load->view('expenses/dashboard', $data);
    }

    public function add() {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
        $this->form_validation->set_rules('expense_date', 'Date', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('expenses/add');
        } else {
            $data = array(
                'user_id'      => $this->session->userdata('user_id'),
                'title'        => $this->input->post('title'),
                'amount'       => $this->input->post('amount'),
                'category'     => $this->input->post('category'),
                'description'  => $this->input->post('description'),
                'expense_date' => $this->input->post('expense_date')
            );
            $this->Expense_model->add_expense($data);
            redirect('expenses/dashboard');
        }
    }

    public function edit($id) {
        $data['expense'] = $this->Expense_model->get_expense_by_id($id);
        
        // Security check: ensure user owns this expense
        if($data['expense']['user_id'] != $this->session->userdata('user_id')){
            redirect('expenses/dashboard');
        }

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('amount', 'Amount', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('expenses/edit', $data);
        } else {
            $update_data = array(
                'title'        => $this->input->post('title'),
                'amount'       => $this->input->post('amount'),
                'category'     => $this->input->post('category'),
                'description'  => $this->input->post('description'),
                'expense_date' => $this->input->post('expense_date')
            );
            $this->Expense_model->update_expense($id, $update_data);
            redirect('expenses/dashboard');
        }
    }

    public function delete($id) {
        // Add security check here as well in production
        $this->Expense_model->delete_expense($id);
        redirect('expenses/dashboard');
    }

    public function export_csv() {
        // 1. Load the necessary helpers explicitly
        $this->load->helper('download'); 
        $this->load->dbutil();
        
        $user_id = $this->session->userdata('user_id');
        
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('expenses');
        
        $csv_data = $this->dbutil->csv_from_result($query);
        
        // 2. Now this function will work
        force_download('my_expenses.csv', $csv_data);
    }
}