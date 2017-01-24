<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Finance extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->lang->load('system_syntax');
        $this->load->model('finance_model');
        $this->load->model('doctor/doctor_model');
        $this->load->model('patient/patient_model');
        $this->load->model('settings/settings_model');
        $data['settings'] = $this->settings_model->getSettings();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!$this->ion_auth->in_group(array('admin', 'Accountant'))) {
            redirect('home/permission');
        }
    }

    public function index() {
        redirect('finance/financial_report');
    }

    public function payment() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['settings'] = $this->settings_model->getSettings();
        $data['payments'] = $this->finance_model->getPayment();

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('payment', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addPaymentView() {
        $data = array();
        $data['discount_type'] = $this->finance_model->getDiscountType();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->finance_model->getPaymentCategory();
        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_payment_view', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addPayment() {
        $id = $this->input->post('id');
        $category_selected = array();
        // $amount_by_category = $this->input->post('category_amount');
        $category_selected = $this->input->post('category_name');
        $cat_and_price = array();
        foreach ($category_selected as $key => $value) {
            $category_price = $this->db->get_where('payment_category', array('category' => $value))->row()->c_price;
            $cat_and_price[] = $value . '*' . $category_price;
            $amount_by_category[] = $category_price;
        }
        $category_name = implode(',', $cat_and_price);

        $patient = $this->input->post('patient');
        $doctor = $this->input->post('doctor');
        $date = time();
        $discount = $this->input->post('discount');
        $amount_received = $this->input->post('amount_received');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Category Field
        // $this->form_validation->set_rules('category_amount[]', 'Category', 'min_length[1]|max_length[100]');
        // Validating Price Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Price Field
        $this->form_validation->set_rules('discount', 'Discount', 'trim|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo 'form validate noe nai re';
            // redirect('accountant/add_new'); 
        } else {
            $amount = array_sum($amount_by_category);
            $sub_total = $amount;
            $discount_type = $this->finance_model->getDiscountType();
            if (!empty($doctor)) {
                $all_cat_name = explode(',', $category_name);
                foreach ($all_cat_name as $indiviual_cat_nam) {
                    $indiviual_cat_nam1 = explode('*', $indiviual_cat_nam);
                    $d_commission = $this->finance_model->getDoctorCommissionByCategory($indiviual_cat_nam1[0])->d_commission;
                    $h_commission = 100 - $d_commission;
                    $hospital_amount_by_category[] = $indiviual_cat_nam1[1] * $h_commission / 100;
                }
                $hospital_amount = array_sum($hospital_amount_by_category);
                if ($discount_type == 'flat') {
                    $flat_discount = $discount;
                    $gross_total = $sub_total - $flat_discount;
                    $doctor_amount = $amount - $hospital_amount - $flat_discount;
                } else {
                    $flat_discount = $sub_total * ($discount / 100);
                    $gross_total = $sub_total - $flat_discount;
                    $doctor_amount = $amount - $hospital_amount - $flat_discount;
                }
            } else {
                $doctor_amount = '0';
                if ($discount_type == 'flat') {
                    $flat_discount = $discount;
                    $gross_total = $sub_total - $flat_discount;
                    $hospital_amount = $gross_total;
                } else {
                    $flat_discount = $amount * ($discount / 100);
                    $gross_total = $sub_total - $flat_discount;
                    $hospital_amount = $gross_total;
                }
            }
            $data = array();
            if (empty($id)) {
                $data = array(
                    'category_name' => $category_name,
                    'patient' => $patient,
                    'date' => $date,
                    'amount' => $sub_total,
                    'doctor' => $doctor,
                    'discount' => $discount,
                    'flat_discount' => $flat_discount,
                    'gross_total' => $gross_total,
                    'amount_received' => $amount_received,
                    'status' => 'unpaid',
                    'hospital_amount' => $hospital_amount,
                    'doctor_amount' => $doctor_amount,
                );
                $this->finance_model->insertPayment($data);
                $inserted_id = $this->db->insert_id();
                $this->session->set_flashdata('feedback', 'Added');
                redirect("finance/invoice?id=" . "$inserted_id");
            } else {
                $data = array(
                    'category_name' => $category_name,
                    'patient' => $patient,
                    'doctor' => $doctor,
                    'amount' => $sub_total,
                    'discount' => $discount,
                    'flat_discount' => $flat_discount,
                    'gross_total' => $gross_total,
                    'amount_received' => $amount_received,
                    'hospital_amount' => $hospital_amount,
                    'doctor_amount' => $doctor_amount
                );
                $this->finance_model->updatePayment($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
                redirect("finance/invoice?id=" . "$id");
            }
        }
    }

    function editPayment() {
        if ($this->ion_auth->in_group(array('admin', 'Accountant'))) {
            $data = array();
            $data['discount_type'] = $this->finance_model->getDiscountType();
            $data['settings'] = $this->settings_model->getSettings();
            $data['categories'] = $this->finance_model->getPaymentCategory();
            $data['patients'] = $this->patient_model->getPatient();
            $data['doctors'] = $this->doctor_model->getDoctor();
            $id = $this->input->get('id');
            $data['payment'] = $this->finance_model->getPaymentById($id);
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_payment_view', $data);
            $this->load->view('home/footer'); // just the footer file
        }
    }

    function delete() {
        if ($this->ion_auth->in_group('admin')) {
            $id = $this->input->get('id');
            $this->finance_model->deletePayment($id);
            $this->session->set_flashdata('feedback', 'Deleted');
            redirect('finance/payment');
        }
    }

    function addPaymentByPatient() {
        $data = array();
        $id = $this->input->get('id');
        $data['patient'] = $this->patient_model->getPatientById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('choose_payment_type', $data);
        $this->load->view('home/footer'); // just the footer fi
    }

    function addPaymentByPatientView() {
        $id = $this->input->get('id');
        $type = $this->input->get('type');
        $data = array();
        $data['discount_type'] = $this->finance_model->getDiscountType();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->finance_model->getPaymentCategory();
        $data['doctors'] = $this->doctor_model->getDoctor();

        $data['patient'] = $this->patient_model->getPatientById($id);
        if ($type == 'gen') {
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_payment_view_single', $data);
            $this->load->view('home/footer'); // just the footer fi
        } else {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('add_ot_payment_view_single', $data);
            $this->load->view('home/footer'); // just the footer fi
        }
    }

    public function paymentCategory() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['categories'] = $this->finance_model->getPaymentCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('payment_category', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addPaymentCategoryView() {
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data);
        $this->load->view('add_payment_category');
        $this->load->view('home/footer'); // just the header file
    }

    public function addPaymentCategory() {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $description = $this->input->post('description');
        $c_price = $this->input->post('c_price');
        $d_commission = $this->input->post('d_commission');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Description Field
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Description Field
        $this->form_validation->set_rules('c_price', 'Category price', 'trim|required|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('add_payment_category');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array('category' => $category,
                'description' => $description,
                'c_price' => $c_price,
                'd_commission' => $d_commission
            );
            if (empty($id)) {
                $this->finance_model->insertPaymentCategory($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->finance_model->updatePaymentCategory($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('finance/paymentCategory');
        }
    }

    function editPaymentCategory() {
        $data = array();
        $id = $this->input->get('id');
        $data['category'] = $this->finance_model->getPaymentCategoryById($id);
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_payment_category', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function deletePaymentCategory() {
        $id = $this->input->get('id');
        $this->finance_model->deletePaymentCategory($id);
        redirect('finance/paymentCategory');
    }

    public function expense() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['settings'] = $this->settings_model->getSettings();
        $data['expenses'] = $this->finance_model->getExpense();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('expense', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addExpenseView() {
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->finance_model->getExpenseCategory();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_expense_view', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addExpense() {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $date = time();
        $amount = $this->input->post('amount');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        // Validating Category Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Generic Name Field
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Company Name Field
        $data['settings'] = $this->settings_model->getSettings();
        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['categories'] = $this->finance_model->getExpenseCategory();
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_expense_view', $data);
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            if (empty($id)) {
                $data = array(
                    'category' => $category,
                    'date' => $date,
                    'amount' => $amount
                );
            } else {
                $data = array(
                    'category' => $category,
                    'amount' => $amount
                );
            }
            if (empty($id)) {
                $this->finance_model->insertExpense($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->finance_model->updateExpense($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('finance/expense');
        }
    }

    function editExpense() {
        $data = array();
        $data['categories'] = $this->finance_model->getExpenseCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $id = $this->input->get('id');
        $data['expense'] = $this->finance_model->getExpenseById($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_expense_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function deleteExpense() {
        $id = $this->input->get('id');
        $this->finance_model->deleteExpense($id);
        redirect('finance/expense');
    }

    public function expenseCategory() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->finance_model->getExpenseCategory();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('expense_category', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addExpenseCategoryView() {
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_expense_category');
        $this->load->view('home/footer'); // just the header file
    }

    public function addExpenseCategory() {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $description = $this->input->post('description');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Description Field
        $data['settings'] = $this->settings_model->getSettings();
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_expense_category');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array('category' => $category,
                'description' => $description
            );
            if (empty($id)) {
                $this->finance_model->insertExpenseCategory($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->finance_model->updateExpenseCategory($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('finance/expenseCategory');
        }
    }

    function editExpenseCategory() {
        $data = array();
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['category'] = $this->finance_model->getExpenseCategoryById($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_expense_category', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function deleteExpenseCategory() {
        $id = $this->input->get('id');
        $this->finance_model->deleteExpenseCategory($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('finance/expenseCategory');
    }

    function invoice() {
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['discount_type'] = $this->finance_model->getDiscountType();
        $data['payment'] = $this->finance_model->getPaymentById($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('invoice', $data);
        $this->load->view('home/footer'); // just the footer fi
    }

    function amountReceived() {
        $id = $this->input->post('id');
        $amount_received = $this->input->post('amount_received');
        $previous_amount_received = $this->db->get_where('payment', array('id' => $id))->row()->amount_received;
        $amount_received = $amount_received + $previous_amount_received;
        $data = array();
        $data = array('amount_received' => $amount_received);
        $this->finance_model->amountReceived($id, $data);
        redirect('finance/invoice?id=' . $id);
    }

    function amountReceivedFromPT() {
        $id = $this->input->post('id');
        $amount_received = $this->input->post('amount_received');
        $payments = $this->finance_model->getPaymentByPatientId($id);
        foreach ($payments as $payment) {
            if ($payment->gross_total != $payment->amount_received) {
                $due_balance = $payment->gross_total - $payment->amount_received;
                if ($amount_received <= $due_balance) {
                    $data = array();
                    $new_amount_received = $amount_received + $payment->amount_received;
                    $data = array('amount_received' => $new_amount_received);
                    $this->finance_model->amountReceived($payment->id, $data);
                    break;
                } else {
                    $data = array();
                    $new_amount_received = $due_balance + $payment->amount_received;
                    $data = array('amount_received' => $new_amount_received);
                    $this->finance_model->amountReceived($payment->id, $data);
                    $amount_received = $amount_received - $due_balance;
                }
            }
        }
        redirect('finance/invoicePatientTotal?id=' . $id);
    }

    function invoicePatientTotal() {
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['discount_type'] = $this->finance_model->getDiscountType();
        $data['payments'] = $this->finance_model->getPaymentByPatientId($id);
        $data['patient_id'] = $id;
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('invoicePT', $data);
        $this->load->view('home/footer'); // just the footer fi
    }

    function lastPaidInvoice() {
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['discount_type'] = $this->finance_model->getDiscountType();
        $data['payments'] = $this->finance_model->lastPaidInvoice($id);
        $data['ot_payments'] = $this->finance_model->lastOtPaidInvoice($id);
        $data['patient_id'] = $id;
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('LPInvoice', $data);
        $this->load->view('home/footer'); // just the footer fi
    }

    function doctorsCommission() {
        $date_from = strtotime($this->input->post('date_from'));
        $date_to = strtotime($this->input->post('date_to'));
        if (!empty($date_to)) {
            $date_to = $date_to + 24 * 60 * 60;
        }
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['payments'] = $this->finance_model->getPaymentByDate($date_from, $date_to);
        $data['ot_payments'] = $this->finance_model->getOtPaymentByDate($date_from, $date_to);
        $data['settings'] = $this->settings_model->getSettings();
        $data['from'] = $this->input->post('date_from');
        $data['to'] = $this->input->post('date_to');
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('doctors_commission', $data);
        $this->load->view('home/footer'); // just the footer fi
    }

    function financialReport() {
        $date_from = strtotime($this->input->post('date_from'));
        $date_to = strtotime($this->input->post('date_to'));
        if (!empty($date_to)) {
            $date_to = $date_to + 24 * 60 * 60;
        }
        $data = array();
        $data['payment_categories'] = $this->finance_model->getPaymentCategory();
        $data['expense_categories'] = $this->finance_model->getExpenseCategory();


        // if(empty($date_from)&&empty($date_to)) {
        //    $data['payments']=$this->finance_model->get_payment();
        //     $data['ot_payments']=$this->finance_model->get_ot_payment();
        //     $data['expenses']=$this->finance_model->get_expense();
        // }
        // else{

        $data['payments'] = $this->finance_model->getPaymentByDate($date_from, $date_to);
        $data['expenses'] = $this->finance_model->getExpenseByDate($date_from, $date_to);
        // } 
        $data['from'] = $this->input->post('date_from');
        $data['to'] = $this->input->post('date_to');
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('financial_report', $data);
        $this->load->view('home/footer'); // just the footer fi
    }

}

/* End of file finance.php */
/* Location: ./application/modules/finance/controllers/finance.php */