<?php
// save_record.php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: nursing_system.php'); // main page
    exit;
}

$form_type = $_POST['form_type'] ?? '';

if ($form_type === 'admission') {

    // ======== ADMISSION FORM SAVE ========
    $patient_id         = $_POST['patient_id'] ?? '';
    $last_name          = $_POST['last_name'] ?? '';
    $first_name         = $_POST['first_name'] ?? '';
    $middle_name        = $_POST['middle_name'] ?? '';
    $sex                = $_POST['sex'] ?? '';
    $dob                = $_POST['dob'] ?? '';
    $age                = $_POST['age'] ?? '';
    $civil_status       = $_POST['civil_status'] ?? '';
    $address            = $_POST['address'] ?? '';

    $ec_name            = $_POST['ec_name'] ?? '';
    $ec_relation        = $_POST['ec_relation'] ?? '';
    $ec_phone           = $_POST['ec_phone'] ?? '';
    $ec_address         = $_POST['ec_address'] ?? '';

    $admission_date     = $_POST['admission_date'] ?? '';
    $admission_time     = $_POST['admission_time'] ?? '';
    $ward               = $_POST['ward'] ?? '';
    $room_bed           = $_POST['room_bed'] ?? '';
    $admission_type     = $_POST['admission_type'] ?? '';
    $physician          = $_POST['physician'] ?? '';
    $chief_complaint    = $_POST['chief_complaint'] ?? '';
    $admitting_diagnosis = $_POST['admitting_diagnosis'] ?? '';

    $trauma_case        = $_POST['trauma_case'] ?? '0';
    $trauma_types       = isset($_POST['trauma_types']) ? implode(', ', $_POST['trauma_types']) : null;
    $trauma_other       = $_POST['trauma_other'] ?? null;
    $trauma_mech        = $_POST['trauma_mech'] ?? null;

    $allergies          = $_POST['allergies'] ?? '';
    $medical_history    = $_POST['medical_history'] ?? '';
    $home_meds          = $_POST['home_meds'] ?? null;

    $guardian_name      = $_POST['guardian_name'] ?? '';
    $guardian_phone     = $_POST['guardian_phone'] ?? '';
    $philhealth         = $_POST['philhealth'] ?? null;
    $primary_nurse      = $_POST['primary_nurse'] ?? null;

    $sql = "INSERT INTO admissions (
                patient_id, last_name, first_name, middle_name, sex, dob, age,
                civil_status, address,
                ec_name, ec_relation, ec_phone, ec_address,
                admission_date, admission_time, ward, room_bed, admission_type,
                physician, chief_complaint, admitting_diagnosis,
                trauma_case, trauma_types, trauma_other, trauma_mech,
                allergies, medical_history, home_meds,
                guardian_name, guardian_phone, philhealth, primary_nurse
            ) VALUES (?,?,?,?,?,?,?,?,?,
                      ?,?,?,?,
                      ?,?,?,?,?,?,
                      ?,?,
                      ?,?,?,?,
                      ?,?,?,
                      ?,?,?,?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        str_repeat('s', 32),
        $patient_id, $last_name, $first_name, $middle_name, $sex, $dob, $age,
        $civil_status, $address,
        $ec_name, $ec_relation, $ec_phone, $ec_address,
        $admission_date, $admission_time, $ward, $room_bed, $admission_type,
        $physician, $chief_complaint, $admitting_diagnosis,
        $trauma_case, $trauma_types, $trauma_other, $trauma_mech,
        $allergies, $medical_history, $home_meds,
        $guardian_name, $guardian_phone, $philhealth, $primary_nurse
    );

    if ($stmt->execute()) {
   
        header('Location: nursing_system.php#vitals-section');
        exit;
    } else {
        die('Error saving admission: ' . $stmt->error);
    }

} elseif ($form_type === 'vitals') {

    // ======== VITALS FORM SAVE ========
    $patient_id      = $_POST['patient_id'] ?? '';
    $patient_name    = $_POST['patient_name'] ?? '';
    $age             = $_POST['age'] ?? '';
    $sex             = $_POST['sex'] ?? '';
    $vs_date         = $_POST['vs_date'] ?? '';
    $vs_time         = $_POST['vs_time'] ?? '';

    $temp            = $_POST['temp'] ?? '';
    $pulse           = $_POST['pulse'] ?? '';
    $resp            = $_POST['resp'] ?? '';
    $bp              = $_POST['bp'] ?? '';
    $spo2            = $_POST['spo2'] ?? '';
    $pain            = $_POST['pain'] ?? '';

    $gcs_e           = $_POST['gcs_e'] ?? '';
    $gcs_v           = $_POST['gcs_v'] ?? '';
    $gcs_m           = $_POST['gcs_m'] ?? '';
    $gcs_total       = $_POST['gcs_total'] ?? '';

    $weight          = $_POST['weight'] ?? '';
    $height          = $_POST['height'] ?? '';
    $bmi             = $_POST['bmi'] ?? '';
    $bmi_category    = $_POST['bmi_category'] ?? '';

    $nurse           = $_POST['nurse'] ?? '';
    $notes           = $_POST['notes'] ?? '';

    $sql = "INSERT INTO vitals (
                patient_id, patient_name, age, sex, vs_date, vs_time,
                temp, pulse, resp, bp, spo2, pain,
                gcs_e, gcs_v, gcs_m, gcs_total,
                weight, height, bmi, bmi_category,
                nurse, notes
            ) VALUES (?,?,?,?,?,?,
                      ?,?,?,?,?,?,
                      ?,?,?,?,
                      ?,?,?,?,
                      ?,?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        str_repeat('s', 22),
        $patient_id, $patient_name, $age, $sex, $vs_date, $vs_time,
        $temp, $pulse, $resp, $bp, $spo2, $pain,
        $gcs_e, $gcs_v, $gcs_m, $gcs_total,
        $weight, $height, $bmi, $bmi_category,
        $nurse, $notes
    );

    if ($stmt->execute()) {
   
        header('Location: nursing_system.php#meds-section');
        exit;
    } else {
        die('Error saving vitals: ' . $stmt->error);
    }

} elseif ($form_type === 'meds') {

    // ======== MEDS FORM SAVE ========
    $patient_id     = $_POST['patient_id'] ?? '';
    $patient_name   = $_POST['patient_name'] ?? '';
    $age            = $_POST['age'] ?? '';
    $med_date       = $_POST['med_date'] ?? '';
    $allergies      = $_POST['med_allergies'] ?? '';
    $diagnosis      = $_POST['med_diagnosis'] ?? '';

    $med_time       = $_POST['med_time'] ?? '';
    $med_name       = $_POST['med_name'] ?? '';
    $med_strength   = $_POST['med_strength'] ?? '';
    $med_dose       = $_POST['med_dose'] ?? '';
    $med_route      = $_POST['med_route'] ?? '';
    $med_frequency  = $_POST['med_frequency'] ?? '';

    $med_indication = $_POST['med_indication'] ?? '';
    $med_status     = $_POST['med_status'] ?? '';
    $med_given_by   = $_POST['med_given_by'] ?? '';

    $med_adverse    = $_POST['med_adverse'] ?? null;
    $med_response   = $_POST['med_response'] ?? null;
    $med_notes      = $_POST['med_notes'] ?? null;

    $sql = "INSERT INTO meds (
                patient_id, patient_name, age, med_date, allergies, diagnosis,
                med_time, med_name, med_strength, med_dose, med_route, med_frequency,
                med_indication, med_status, med_given_by,
                med_adverse, med_response, med_notes
            ) VALUES (?,?,?,?,?,?,
                      ?,?,?,?,?,?,
                      ?,?,?,?,
                      ?,?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        str_repeat('s', 18),
        $patient_id, $patient_name, $age, $med_date, $allergies, $diagnosis,
        $med_time, $med_name, $med_strength, $med_dose, $med_route, $med_frequency,
        $med_indication, $med_status, $med_given_by,
        $med_adverse, $med_response, $med_notes
    );

    if ($stmt->execute()) {
   
        header('Location: nursing_system.php?success=1');
        exit;
    } else {
        die('Error saving meds: ' . $stmt->error);
    }

} else {
    die('Invalid form type.');
}
?>
