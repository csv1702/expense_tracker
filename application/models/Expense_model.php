<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expense_model extends CI_Model {

    public function get_expenses($user_id, $filter = 'all') {
        $this->db->where('user_id', $user_id);

        // Filter Logic
        if ($filter == 'daily') {
            $this->db->where('expense_date', date('Y-m-d'));
        } elseif ($filter == 'monthly') {
            $this->db->where('MONTH(expense_date)', date('m'));
            $this->db->where('YEAR(expense_date)', date('Y'));
        } elseif ($filter == 'yearly') {
            $this->db->where('YEAR(expense_date)', date('Y'));
        }

        $this->db->order_by('expense_date', 'DESC');
        return $this->db->get('expenses')->result_array();
    }

    // --- NEW FUNCTION ADDED FOR CHART ---
    public function get_chart_data($user_id) {
        $this->db->select('category, SUM(amount) as total');
        $this->db->where('user_id', $user_id);
        $this->db->group_by('category');
        $query = $this->db->get('expenses');
        return $query->result_array();
    }
    // ------------------------------------

    public function add_expense($data) {
        return $this->db->insert('expenses', $data);
    }

    public function get_expense_by_id($id) {
        return $this->db->get_where('expenses', array('id' => $id))->row_array();
    }

    public function update_expense($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('expenses', $data);
    }

    public function delete_expense($id) {
        $this->db->where('id', $id);
        return $this->db->delete('expenses');
    }

    public function get_summary($user_id) {
        // Total Expense
        $this->db->select_sum('amount');
        $this->db->where('user_id', $user_id);
        $total = $this->db->get('expenses')->row()->amount;

        // This Month
        $this->db->select_sum('amount');
        $this->db->where('user_id', $user_id);
        $this->db->where('MONTH(expense_date)', date('m'));
        $this->db->where('YEAR(expense_date)', date('Y'));
        $month = $this->db->get('expenses')->row()->amount;

        return ['total' => $total ?? 0, 'month' => $month ?? 0];
    }
}