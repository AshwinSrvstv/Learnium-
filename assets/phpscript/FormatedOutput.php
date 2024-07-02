<?php

function SelectOptionsFormArray($Array,$SelectedValue)
{
    $Output="";
    foreach($Array as $Temp)
    {
        if($Temp==$SelectedValue){ $Output=$Output."<option selected>".$Temp."</option>";}
        else{ $Output=$Output."<option>".$Temp."</option>";}
    }
    return $Output;
}
function SelectOptionsFormResult($result,$SelectedValue)
{
    $Output="";
    while($row=mysqli_fetch_array($result))
    {
        
        if($row[0]==$SelectedValue){ $Output=$Output."<option selected>".$row[0]."</option>";}
        else{ $Output=$Output."<option>".$row[0]."</option>";}
    }
    return $Output;
}
function SelectOptionsWithValues($result,$SelectedValue)
{
    $Output="";
    while($row=mysqli_fetch_array($result))
    {
        if($row[1]==$SelectedValue){ $Output=$Output."<option value='".$row[0]."' selected>".$row[1]."</option>";}
        else{ $Output=$Output."<option value='".$row[0]."'>".$row[1]."</option>";}
    } 
    return $Output;
}
function SelectOptionsWithValuesArray($Options,$Values,$SelectedValue)
{
    $Output="";
    $count=0;
    foreach($Options as $Temp)
    {
        if($Values[$count]==$SelectedValue){ $Output=$Output."<option value='".$Values[$count]."' selected>".$Temp."</option>";}
        else{ $Output=$Output."<option value='".$Values[$count]."' >".$Temp."</option>";}
        $count++;
    }
    return $Output;
}
function SelectOptionsWithValues2($result,$SelectedValue)
{
    $Output="";
    while($row=mysqli_fetch_array($result))
    {
        if($SelectedValue==$row[0]){$Selected="selected";}else{$Selected="";}
         $Output = $Output . "<option value='".$row[0]."'". $Selected.">".$row[1]."</option>";
    }
    return $Output;
}
function SelectOptionsWithResultRemoveArrayValues($result,$SelectedValue,$ArrayValuesToFilter)
{
    $Output="";
    while($row=mysqli_fetch_array($result))
    {
        $Add=false;
        foreach($ArrayValuesToFilter as $var)       {if($var==$row[0])       {$Add=true;break;}   }    
        if($Add){continue;}
        if($row[0]==$SelectedValue && !$Add){ $Output=$Output."<option selected>".$row[0]."</option>";}
        else{ $Output=$Output."<option>".$row[0]."</option>";}
    }
    return $Output;
}
function GetFileArray($Path)
{
    $temp="";
    // Open a directory, and read its contents
    if (is_dir($Path))
    {
        if ($dh = opendir($Path)){
            while (($file = readdir($dh)) !== false) { echo $temp ."," . $file;}
            closedir($dh);
        }
        return explode(",",$temp);
    }
    else{return false;}
}
function GetFileArrayOfExtension($Path,$Extension)
{
    $temp="";
    // Open a directory, and read its contents
    if (is_dir($Path))
    {
        if ($dh = opendir($Path)){
           
            while (($file = readdir($dh)) !== false) { $temp=pathinfo($file);if($temp["extension"]==$Extension){ $temp=$temp ."," . $file;}}
            closedir($dh);
        }
        if (strpos($temp, ',') !== false) {$temp=substr($temp,1);}
        return explode(",",$temp);
    }
    else{return false;}
    
}
function search_file($dir,$file_to_search){

    $files = scandir($dir);

    foreach($files as $key => $value){

        $path = realpath($dir.DIRECTORY_SEPARATOR.$value);

        if(!is_dir($path)) {
            if($file_to_search == $value){return true;}

        } else if($value != "." && $value != ".."){ search_file($path, $file_to_search); }  
    } 
}
function search_file_in_Directory($dir,$file_to_search){

    $files = scandir($dir);

    foreach($files as $value)
    {

        $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
        if(is_dir($path)){continue;}
        if($file_to_search == $value){return true;}
        //else{return false;}

    } 
    return false;
}
function DeleteFromArray($Array,$Value)
{
    $Array = array_filter($Array); 
    if (($key = array_search($Value, $Array)) !== false) {
        unset($Array[$key]);
    }
}
function PrintAlert($Var,$AlertType)// $AlertType = warning / info / danger / success
{
    if(isset($Var) && $Var!="") 
    {
        if($Var=="")return;

        $Icon="<i class='fas fa-info-circle'></i>";
        $Icon="<i class='fas fa-exclamation-triangle'></i>";

        echo '<div class="alert alert-'.$AlertType.'" role="alert"><span><strong>'. $Var.'</strong></span></div>';
    }
    
}
function PrintAlertWithIcon($Var,$AlertType,$Icon)// $AlertType = warning / info / danger / success
{
    if($Var=="")return;
    $Class="";
    if($Icon=="Info"){$Class="<i class='fas fa-info-circle'></i>";}
    if($Icon=="Exclamation"){$Class="<i class='fas fa-exclamation-triangle'></i>";}
    if($Icon=="Ok" || $Icon=="Check"){$Class="<i class='fas fa-check'></i>";}
    if($Icon=="Warning"){$Class="<i class='fas fa-info-warning'></i>";}
    if($Icon=="Edit"){$Class="<i class='fas fa-info-edit'></i>";}

    if($Icon=="Search"){$Class="<i class='fas fa-info-search'></i>";}
    if($Icon=="Star" || $Icon=="Rating"){$Class="<i class='fas fa-info-star'></i>";}
    if($Icon=="Close"|| $Icon=="Error" ||$Icon=="Cross"){$Class="<i class='fas fa-info-warning'></i>";}
    if($Icon=="Heart"){$Class="<i class='fas fa-info-Heart'></i>";}
    if($Icon=="Bulb" || $Icon=="Tips"){$Class="<i class='far fa-lightbulb'></i>";}
    if(isset($Var) && $Var!="") 
    {
        echo '<div class="alert alert-'.$AlertType.'" role="alert">'.$Class.' <span><strong>'. $Var.'</strong></span></div>';
    }
    
}
function PrintSmartAlert($Message)// $AlertType = warning / info / danger / success
{ 
    if($Message=="")return;
    $AlertType =explode("-#-",$Message)[0];
    $Var=explode("-#-",$Message)[1];
    if(isset($Var) && $Var!="") 
    {
        echo '<div class="alert alert-'.$AlertType.'" role="alert"><span><strong>'. $Var.'</strong></span></div>';
    }
}
function PrintVar($Var)// print $Var if exist.
{
    if(isset($Var)&&$Var!="") echo  $Var;
    else echo"";
}

function PrintImage($ImagePath,$DefaultImagePath,$Height,$Width)//Default Image Will be Shown when ImagePath does not exist
{
    if(file_exists($ImagePath))
    {echo '<img class="img-responsive" src="'. $ImagePath.'" width="'.$Width.'" height="'.$Height.'">';}
    else
    {echo '<img class="img-responsive" src="'. $DefaultImagePath.'" width="'.$Width.'" height="'.$Height.'">';}
}

function PrintCrumbBarArray($BreadCrumbElement)
{ 
    if(count($BreadCrumbElement)==0)return;
    echo '<ol class="breadcrumb">';
    for($n=0;$n<count($BreadCrumbElement);$n++)
    {
        echo '<li><a><span>'.$BreadCrumbElement[$n].'</span></a></li>';
    }
    echo "</ol>";
}
function PrintCrumbBarAssociativeArray($BreadCrumbElement,$ThemeType)
{ 
    if(count($BreadCrumbElement)==0)return;
    echo '<ol class="breadcrumb">';
    foreach($BreadCrumbElement as $x => $x_value){
        echo '<li><a class="text-'.$ThemeType.'" href='.$x_value.'><span>'.$x.'</span></a></li>';
    }
    echo "</ol>";
}
function PrintProgressBar($ProgressValue)
{
    echo '<div class="progress">';
    echo '<div class="progress-bar progress-bar-striped active" style="width: '.$ProgressValue.'%;">'.$ProgressValue.'%</div></div>';
}
function PrintProgressBarAdvanced($ProgressValue,$MinValue=0,$MaxValue=100,$Message="",$Theme='primary',$IsStriped=true,$IsActive=true)
{
    $class="";
    $Percentage=$ProgressValue *100 / $MaxValue;
    if($IsStriped)$class=$class." progress-bar-striped";
    if($IsActive)$class=$class." active";
    $class=$class." progress-bar-".$Theme;
    echo '<div class="progress">';
    echo '<div class="progress-bar'.$class.'" aria-valuenow="50" aria-valuemin="0" aria-valuemax="1000" style="width: '.$Percentage.'%;">'.$Message.'</div>';
    echo '</div>';
}


?>