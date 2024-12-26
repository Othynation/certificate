<?php $rows=$getCredit->get_by_id('pgeneral','id',1); 
foreach($rows as $row)
{
$webtitle=$row['web_title'];
$headertitle=$row['web_title'];
$weburl=$row['web_url'];
$pathu=$row['web_path'];
$logo=$row['logo'];
$wemail=$row['contact_email'];
$certificate_header_sub_heading=$row['reg'];
$certificate_header_address=$row['web_desc'];
$certificate_header_email=$row['contact_email'];
$theme_color=$row['color'];
$indiatl_no=$row['web_tags'];
$format=$row['currency'];
}
?> 