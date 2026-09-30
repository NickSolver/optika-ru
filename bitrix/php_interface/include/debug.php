<?
function check_user_debug(){
    global $USER;
    if($USER->IsAdmin() && $USER->GetID() == DEBUG_USER_ID){
        return true;
    }
    return false;
}
function avar_dump($data)
{
    global $USER;
    if(check_user_debug()){
        $bt = debug_backtrace();
        $bt = $bt[0];
        $dRoot = $_SERVER["DOCUMENT_ROOT"];
        $dRoot = str_replace("/","\\",$dRoot);
        $bt["file"] = str_replace($dRoot,"",$bt["file"]);
        $dRoot = str_replace("\\","/",$dRoot);
        $bt["file"] = str_replace($dRoot,"",$bt["file"]);
        ?>
        <div style='font-size:9pt; color:#000; background:#fff; border:1px dashed #000;'>
          <div style='padding:3px 5px; background:#99CCFF; font-weight:bold;'>File: <?=$bt["file"]?> [<?=$bt["line"]?>]</div>
          <pre style='padding:10px;'><?var_dump($data)?></pre>
      </div>
      <?
  }
}

function file_var_dump($arParams = array(), $mode = "a"){
    $fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/check_file.txt", $mode);
    ob_start();
    echo "===================\r\n";
    var_dump($arParams);
    echo "===================\r\n";
    $mytext = ob_get_clean();
    fwrite($fp, $mytext);
    fclose($fp);
}