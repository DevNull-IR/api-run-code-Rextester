<?php
error_reporting(0);
header( 'Content-Type: application/json' );
function run ( $lang , $code ){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://rextester.com/rundotnet/Run' );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "LanguageChoiceWrapper={$lang}&Program=" . urlencode ( $code ) );
return json_decode(curl_exec($ch),true);
curl_close($ch);
}
$type = @$_REQUEST[ 'type' ];
$code = @$_REQUEST[ 'code' ];
$langs = [
    'php'=>8,
    'asm'=>15,
    'bash'=>38,
    'csharp'=>1,
    'cppgcc'=>7,
    'cgcc'=>6,
    'cclang'=>26,
    'clojure'=>47,
    'commonlisp'=>18,
    'd'=>30,
    'erlang'=>40,
    'fsharp'=>3,
    'go'=>20,
    'python'=>5,
    'perl'=>13,
    'javascript'=>23,
    'python3'=>24,
    'oracle'=>35,
    'mysql'=>33,
    'lua'=>14,
    'kotlin'=>43
];
$langsss = [];
foreach($langs as $key => $value){
    $langsss[$key] = $key;
}
if (isset($code) && !empty($code)){
        if (isset($type) && !empty($type)){
            if ($type == "php")
            $code = "<?php $code";
        $run = run($langs[$type],$code);
        echo json_encode([
            'result'=>$run['Result'],
            'errors'=>$run['Errors'],
            'status'=>$run['Stats'],
            'langs'=>$langsss],
                         448);
    }
}
