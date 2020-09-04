<?php  
// $ketqua = [];
$ketqua['httt_ten'][] = [
    'rule' => 'required',
    'rule_value' => True,
    'value' => 'Lam'
];
$ketqua['httt_ten'][] = [
    'rule' => 'required',
    'rule_value' => false,
    'value' => 'Phuc'
];
$ketqua['httt_ho'][] = [
    'rule' => 'required',
    'rule_value' => True,
    'value' => 'Lam'
];
$ketqua['httt_ho'][] = [
    'rule' => 'required',
    'rule_value' => false,
    'value' => 'Phuc'
];
$ketqua['httt_ho'][] = [
    'rule' => 'required',
    'rule_value' => false,
    'value' => 'PhucLam'
];

// foreach($ketqua as $fileds){
//     foreach($fileds as $filed){
//         echo $filed['value'].'<br/>';
//     };

// }

echo "<pre>";
echo print_r($ketqua);
echo "</pre>";
?>