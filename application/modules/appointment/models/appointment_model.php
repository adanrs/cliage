<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Appointment_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertAppointment($data) {

        $this->db->insert('appointment', $data);
    }

    function getAppointment() {
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentForCalendar() {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('appointment');
        return $query->row();
    }

    function getAppointmentByDate($date_from, $date_to) {
        $this->db->select('*');
        $this->db->from('appointment');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function updateAppointment($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('appointment', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('appointment');
    }

    function updateIonUser($username, $email, $password, $ion_user_id) {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }

}
