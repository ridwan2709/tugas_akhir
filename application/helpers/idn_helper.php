<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Helpers Idn_helper_helper
 *
 * This Helpers for ...
 * 
 * @package   CodeIgniter
 * @category  Helpers
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 *
 */

// ------------------------------------------------------------------------

// session autentikasi API IDN
function user_idn()
{
  $username = 10038;
  $pass = hash('sha256', '06kBachMg6nExXIb');
  $password = hash('sha256', $pass . date('Ymd'));
  return base64_encode("$username:$password");
}

// baseUrl API
function route_idn()
{
  $base_route = 'https://testclient.infradigital.io/';
  return $base_route;
}

// mengambil semua data siswa dari IDN
if (!function_exists('idn_get_bill')) {
  /**
   * Test
   *
   * This test helpers
   *
   * @param   ...
   * @return  ...
   */
  function idn_get_bill()
  {

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => route_idn() . 'bill',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Basic ' . user_idn()
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
  }
}

// mengambil data siswa sesuai NIS
if (!function_exists('idn_get_student')) {
  /**
   * Test
   *
   * This test helpers
   *
   * @param   ...
   * @return  ...
   */
  function idn_get_student($nis)
  {

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => route_idn() . 'bill/' . $nis,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_POSTFIELDS => '{
        "name": "AGUS SUSILO",
        "bill_key_value": "20200101",
        "bill_key_name": "STUDENT_ID", 
        "phone": "62815",
        "email": "agus@idnmail.com",
        "description": "Kelas 1",
        "branch_code": "" 
        }',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Basic ' . user_idn(),
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $result = json_decode($response, true);
    return $result;
  }
}

// input data siswa
if (!function_exists('idn_post_student')) {
  /**
   * Test
   *
   * This test helpers
   *
   * @param   ...
   * @return  ...
   */
  function idn_post_student($name, $nis, $id, $phone, $email, $desc)
  {



    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => route_idn() . '/bill',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => '{
      "name": "' . $name . '",
      "bill_key_value": "' . $nis . '",
      "bill_key_name": "' . $id . '", 
      "phone": "' . $phone . '",
      "email": "' . $email . '",
      "description": "' . $desc . '",
      "branch_code": "" 
      }',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Basic ' . user_idn(),
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
  }
}

// update data siswa
if (!function_exists('idn_put_student')) {
  /**
   * Test
   *
   * This test helpers
   *
   * @param   ...
   * @return  ...
   */
  function idn_put_student($name, $nis, $id, $phone, $email, $desc)
  {

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => route_idn() . 'bill',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'PUT',
      CURLOPT_POSTFIELDS => '{
        "name": "' . $name . '",
        "bill_key_value": "' . $nis . '",
        "bill_key_name": "' . $id . '", 
        "phone": "' . $phone . '",
        "email": "' . $email . '",
        "description": "' . $desc . '",
        "branch_code": "" 
      }',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Basic ' . user_idn(),
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return  $response;
  }
}

// input tagihan siswa
if (!function_exists('idn_post_invoice')) {
  /**
   * Test
   *
   * This test helpers
   *
   * @param   ...
   * @return  ...
   */
  function idn_post_invoice($data)
  {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => route_idn() . 'bill_component',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => '{
        "create_by":"' . $data['created_by'] . '",
        "biller_code":"10038", 
        "branch_code":null,
        "bill_key":"' . $data['bill_key'] . '", 
        "account_code":"MANDIRI",
        "bill_component_name":"' . $data['component_name'] . '",
        "expiry_date":"' . $data['expired_date'] . '", 
        "due_date":"' . $data['due_date'] . '", 
        "active_date":"' . $data['aktive_date'] . '", 
        "amount":' . $data['amount'] . ', 
        "penalty_amount":' . $data['penalty'] . ', 
        "batch_id":"999" 
    }',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Basic ' . user_idn(),
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
  }
}

// update tagihan siswa
if (!function_exists('idn_put_invoice')) {
  /**
   * Test
   *
   * This test helpers
   *
   * @param   ...
   * @return  ...
   */
  function idn_put_invoice($data)
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => route_idn() . 'bill_component',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'PUT',
      CURLOPT_POSTFIELDS =>'{
      "id":"'. $data['id'].'",
      "last_update_by":"'.$data['last_update_by'].'",
      "biller_code":"10038",
      "branch_code":null,
      "bill_key":"'.$data['bill_key'].'",
      "account_code":"MANDIRI",
      "bill_component_name":"'.$data['component_name'].'",
      "expiry_date":"' . $data['expired_date'] . '", 
      "due_date":"' . $data['due_date'] . '", 
      "active_date":"' . $data['aktive_date'] . '", 
      "amount":' . $data['amount'] . ', 
      "penalty_amount":' . $data['penalty'] . ', 
      "batch_id":"333"
    }',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Basic '. user_idn(),
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
  }
}

// input tagihan siswa
if (!function_exists('idn_delete_invoice')) {
  /**
   * Test
   *
   * This test helpers
   *
   * @param   ...
   * @return  ...
   */
  function idn_delete_invoice($data)
  {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => route_idn() . 'bill_component/delete',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => '{
          "update_by":"'.$data['update_by'].'",
          "bill_component_id":
          [
              "'.$data['id'].'"
          ]
    }',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Basic ' . user_idn(),
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
  }
}





// ------------------------------------------------------------------------

/* End of file Idn_helper_helper.php */
/* Location: ./application/helpers/Idn_helper_helper.php */