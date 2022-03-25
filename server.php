<?php

/**
 * Oracle connection
 */
if (!defined("ENVIRONMENT"))
    define("ENVIRONMENT", "live");

$connection_string = "(DESCRIPTION =
(ADDRESS = (PROTOCOL = TCP)(HOST = 127.0.0.1)(PORT = 3838))
(CONNECT_DATA =
  (SERVER = DEDICATED)
  (SERVICE_NAME = RAJAN)
))";

$oraConnection = oci_connect('username', 'password', $connection_string);
if (!$oraConnection) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

/**
 * Where query For search
 */
$where = "";
if (!empty($_REQUEST['search']['value'])) {
    $search = trim($_REQUEST['search']['value']);
    $where .= " WHERE upper(CUSTOMER_CODE) LIKE UPPER('%$search%')";
    $where .= " OR upper(FINACLE_CODE) LIKE UPPER('%$search%') ";
    $where .= " OR upper(CUSTOMER_NAME) LIKE UPPER('%$search%')";
    $where .= " OR upper(MOBILE_NUMBER) LIKE UPPER('%$search%')";
    $where .= " OR upper(PAN_NUMBER) LIKE UPPER('%$search%')";
    $where .= " OR upper(CUSTOMER_ADDRESS) LIKE UPPER('%$search%') ";
}

/**
 * Count Total Record in database
 */
$totalRecordsSql = "SELECT count(*) as total FROM NOC_DATA $where";
$stmt = oci_parse($oraConnection, $totalRecordsSql);
oci_execute($stmt);
$res = oci_fetch_row($stmt);
$totalRecords = $res[0];
oci_free_statement($stmt);


/**
 * Make Column
 */
$columns = array(
    0 => 'CUSTOMER_CODE',
    1 => 'FINACLE_CODE',
    2 => 'CUSTOMER_NAME',
    3 => 'MOBILE_NUMBER',
    4 => 'PAN_NUMBER',
    5 => 'CUSTOMER_ADDRESS'
);


/**
 * Select query 
 */
$sql = "SELECT CUSTOMER_CODE,FINACLE_CODE, CUSTOMER_NAME,MOBILE_NUMBER,PAN_NUMBER,CUSTOMER_ADDRESS FROM NOC_DATA $where";

/**
 * This is for ordering
 */
$orderBy = $columns[$_REQUEST['order'][0]['column']];
$order = $_REQUEST['order'][0]['dir'];
$offset = $_REQUEST['start'];
$limit = $_REQUEST['length'];

$sql .= " ORDER BY $orderBy $order OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";

/**
 * Fetch only 10 record
 */
$stmt = oci_parse($oraConnection, $sql);
oci_execute($stmt);
oci_fetch_all($stmt, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
oci_free_statement($stmt);
oci_close($oraConnection);
/**
 * Make datatable Data
 */

$json_data = array(
    "draw"            => intval($_REQUEST['draw']),
    "recordsTotal"    => intval($totalRecords),
    "recordsFiltered" => intval($totalRecords),
    "data"            => $result   // total data array
);

echo json_encode($json_data);
